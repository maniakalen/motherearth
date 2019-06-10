<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 5:14 PM
 */

namespace common\components;


use common\interfaces\GeoUnitsInterface;
use common\models\GeoUnits;
use common\models\GeoUnitTypes;
use maniakalen\maps\components\Location;
use yii\base\Component;
use yii\base\InvalidValueException;
use yii\helpers\ArrayHelper;

class GeoUnitsManager extends Component
{
    public function searchGeoUnit($name)
    {
        return \Yii::$app->location->getGeoUnitCoords($name);
    }

    public function searchByCoords($lat, $lon)
    {
        return json_decode(\Yii::$app->location->searchCoords($lat, $lon), JSON_UNESCAPED_UNICODE);
    }

    public function registerGeoUnit($name, $parent, $type, $lat, $lon)
    {
        if ($unit = GeoUnits::find()->where(['name' => $name, 'type' => $type])->one()) {
            return $unit->id;
        }
        $geounit = \Yii::createObject(GeoUnits::className());
        $geounit->name = $name;
        $geounit->type = lcfirst($type);
        $geounit->lat = (string)$lat;
        $geounit->lon = (string)$lon;
        $geounit->parent_id = $parent;
        if ($geounit->save()) {
            return $geounit->id;
        }
        \Yii::error(print_r($geounit->errors, 1) . ' ' . $type, 'geounits');
        return false;
    }

    public function registerUnits($data, $type)
    {
        static $types = ['HouseNumber' => 'District', 'Street' => 'District', 'District' => 'City', 'City' => 'County'];
        $parentType = isset($types[$type])?$types[$type]:null;
        if (isset($data['Response']['View'][0]['Result'])) {
            $unit = $data['Response']['View'][0]['Result'][0];
        } else {
            $unit = $data;
        }

        $lat = $unit['Location']['DisplayPosition']['Latitude'];
        $lon = $unit['Location']['DisplayPosition']['Longitude'];
        $address = $unit['Location']['Address'];
        $parentUnitName = isset($address[$parentType])?$address[$parentType]:null;
        if ($parentType) {
            $geoUnit = \Yii::$app->location->searchGeoUnit($parentUnitName, ['country' => 'BGR', $parentType => $parentUnitName]);
            if (is_string($geoUnit)) {
                $geoUnit = json_decode($geoUnit, JSON_UNESCAPED_UNICODE);
            }
            $parentId = $this->registerUnits($geoUnit, $parentType);
        } else {
            $parentId = null;
        }

        if (in_array($type, ['HouseNumber', 'Street'])) {
            $name = $address['Label'];
        } else {
            $name = isset($address[$type])?$address[$type]:strtolower($unit['MatchLevel']);
        }

        return $this->registerGeoUnit($name, $parentId, $type, $lat, $lon);
    }
}