<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "geo_units".
 *
 * @property int $id
 * @property int $type
 * @property string $name
 * @property string $lat
 * @property string $lon
 *
 * @property UserLocations[] $userLocations
 * @property UserLocations[] $userLocations0
 */
class GeoUnits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geo_units';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name', 'lat', 'lon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'name' => 'Name',
            'lat' => 'Lat',
            'lon' => 'Lon',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLocations()
    {
        return $this->hasMany(UserLocations::className(), ['city' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLocations0()
    {
        return $this->hasMany(UserLocations::className(), ['province' => 'id']);
    }
}
