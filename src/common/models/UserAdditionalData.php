<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_additional_data".
 *
 * @property int $id
 * @property int $user_id
 * @property string $phone
 * @property string $details
 */
class UserAdditionalData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_additional_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['details'], 'string'],
            [['phone'], 'string', 'max' => 255],
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
            'phone' => 'Phone',
            'details' => 'Details',
        ];
    }
}
