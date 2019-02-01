<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 5:14 PM
 */

namespace common\components;


use common\models\GeoUnits;
use common\models\GeoUnitTypes;
use maniakalen\maps\components\Location;
use yii\base\Component;
use yii\base\InvalidValueException;
use yii\helpers\ArrayHelper;

class GeoUnitsManager extends Component
{
    private $types = [];
    public function init()
    {
        parent::init();
        $this->types = ArrayHelper::map(GeoUnitTypes::find()->all(), 'id', 'name');
    }

    public function getGeoUnitsByType($typeId)
    {
        return GeoUnits::findAll(['type' => $typeId]);
    }

    public function getProvinces()
    {
        return $this->getGeoUnitsByType($this->getTypeId('province'));
    }

    public function getCities()
    {
        return $this->getGeoUnitsByType($this->getTypeId('city'));
    }

    public function getTypeId($type)
    {
        $types = array_flip($this->types);
        if (!isset($types[$type])) {
            throw new InvalidValueException("Missing GeoUnit type value");
        }
        return $types[$type];
    }

    public function searchGeoUnit($name)
    {
        $unit = \Yii::$app->location->searchGeoUnit($name);
    }
}