<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_locations".
 *
 * @property int $id
 * @property int $user_id
 * @property string $lat
 * @property string $lon
 * @property int $province
 * @property int $city
 * @property string $address
 *
 * @property GeoUnits $city0
 * @property GeoUnits $province0
 * @property User $user
 */
class UserLocations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_locations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'address'], 'integer'],
            [['address'], 'exist', 'skipOnError' => true, 'targetClass' => GeoUnits::className(), 'targetAttribute' => ['address' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'lat' => 'Lat',
            'lon' => 'Lon',
            'province' => 'Province',
            'city' => 'City',
            'address' => 'Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity0()
    {
        return $this->hasOne(GeoUnits::className(), ['id' => 'city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvince0()
    {
        return $this->hasOne(GeoUnits::className(), ['id' => 'province']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
