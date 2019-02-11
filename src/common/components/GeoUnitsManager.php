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

    public function registerGeoUnit($name, $parent, $lat, $lon)
    {
        if ($unit = GeoUnits::find()->where(['name' => $name, 'parent_id' => $parent])->one()) {
            return $unit->id;
        }
        $geounit = \Yii::createObject(GeoUnits::className());
        $geounit->name = $name;
        $geounit->lat = (string)$lat;
        $geounit->lon = (string)$lon;
        $geounit->parent_id = $parent;
        return $geounit->save()?$geounit->id:false;
    }

    public function populateMissingUnits($r)
    {
        foreach ($r as $unit) {


            if (!in_array(strtolower($unit['MatchLevel']), $types)) {
                foreach ($unit['MatchQuality'] as $type => $quality) {
                    if ($quality == 1 && in_array(strtolower($type), $types)) {
                        $name = $unit['Location']['Address'][$type];
                        if (!GeoUnits::findOne(['name' => $name, 'type' => strtolower($type)])) {
                            $params = ['country' => 'BGR', strtolower($type) => $name];
                            $data = json_decode(\Yii::$app->location->searchGeoUnit($name, $params), JSON_UNESCAPED_UNICODE);
                            if (isset($data['Response']['View'][0]['Result'])) {
                                $u = $data['Response']['View'][0]['Result'][0];
                                $lat = $u['Location']['DisplayPosition']['Latitude'];
                                $lon = $u['Location']['DisplayPosition']['Longitude'];
                                $this->registerGeoUnit($type, $name, $lat, $lon);
                            }
                        }
                    }
                }
            } else {
                $type = strtolower($unit['MatchLevel']);
                $name = $unit['Location']['Address'][$type];
                if (!GeoUnits::findOne(['name' => $name, 'type' => strtolower($type)])) {
                    $params = ['country' => 'BGR', strtolower($type) => $name];
                    $data = json_decode(\Yii::$app->location->searchGeoUnit($unit, $params), JSON_UNESCAPED_UNICODE);
                    if (isset($data['Response']['View'][0]['Result'])) {
                        $unit = $data['Response']['View'][0]['Result'][0];
                        $lat = $unit['Location']['DisplayPosition']['Latitude'];
                        $lon = $unit['Location']['DisplayPosition']['Longitude'];
                        $this->registerGeoUnit($type, $unit['Location']['Address'][$type], $lat, $lon);
                    }
                }
            }
        }
    }

    public function registerUnits($data, $type)
    {
        static $types = ['Street' => 'District', 'District' => 'City', 'City' => 'County'];

        $parent = $this->registerUnits($data, isset($types[$type])?$types[$type]:null);
        if (isset($data['Response']['View'][0]['Result'])) {
            $unit = $data['Response']['View'][0]['Result'][0];
            $lat = $unit['Location']['DisplayPosition']['Latitude'];
            $lon = $unit['Location']['DisplayPosition']['Longitude'];
            $address = $unit['Location']['Address'];
            if ($type === 'Street') {
                $name = $address['Label'];
            } else {
                $name = $address[$type];
            }

            return $this->registerGeoUnit($name, $parent, $lat, $lon);

        }
        return null;
    }
}