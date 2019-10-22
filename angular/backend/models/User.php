<?php

namespace app\models;

use app\assets\FontAwesomeBrands;
use maniakalen\admingui\interfaces\GridModelInterface;
use maniakalen\widgets\ActiveForm;
use maniakalen\widgets\interfaces\ActiveFormModel;
use yii\bootstrap\Html;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class User extends ActiveRecord implements \yii\web\IdentityInterface, GridModelInterface, ActiveFormModel
{
    const SCENARIO_STATUS_TOGGLE = 'status_toggle';
    public $password_confirm;
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $model = $this;
        return [
            [['status'], 'boolean', 'on' => [static::SCENARIO_DEFAULT, static::SCENARIO_STATUS_TOGGLE]],
            [['username'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['created_at'], 'double', 'on' => self::SCENARIO_DEFAULT],
            [['password_hash', 'password_confirm'], 'string', 'max' => 255, 'on' => self::SCENARIO_DEFAULT],
            [['password_hash'], 'compare', 'compareAttribute' => 'password_confirm', 'on' => self::SCENARIO_DEFAULT],
            [['password_hash'], function($attribute, $params, $validator) use ($model) {
                $model->$attribute = \Yii::$app->getSecurity()->generatePasswordHash($model->$attribute);
            }, 'on' => self::SCENARIO_DEFAULT]
        ];
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $limit = time() - 1800;
        return static::find()->where(['auth_key' => $token])->andWhere(['>', 'auth_key_last_use', $limit])->one();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->where(['username' => $username])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPermissions()
    {
        return \Yii::$app->authManager->getPermissionsByUser($this->id);
    }

    public function getFieldsSignature()
    {
        $rules = [
            static::SCENARIO_DEFAULT => [
                'username' => ['type' => ActiveForm::FIELD_TYPE_TEXT, 'options' => ['max' => 255, 'style' => 'max-width: 650px;']],
                'email' => ['type' => ActiveForm::FIELD_TYPE_TEXT, 'options' => ['max' => 255, 'style' => 'max-width: 650px;']],
                'password_hash' => ['type' => ActiveForm::FIELD_TYPE_PASSWORD, 'options' => ['max' => 255, 'style' => 'max-width: 650px;', 'value' => '']],
                'password_confirm' => ['type' => ActiveForm::FIELD_TYPE_PASSWORD, 'options' => ['max' => 255, 'style' => 'max-width: 650px;']],
                'status' => [
                    'type' => ActiveForm::FIELD_TYPE_CHECKBOX,
                    'label' => 'Active',
                    'options' => ['checked' => 'checked']
                ]
            ],
        ];
        $scenario = $this->getScenario();
        return isset($rules[$scenario])?$rules[$scenario]:[];
    }

    public function getCreateAction()
    {
        return Url::to(['create']);
    }

    public function getUpdateAction()
    {
        return Url::to(['edit', 'id' => $this->id]);
    }

    public function getFormBlocks()
    {
        return [];

    }

    public function getGridColumnsDefinition()
    {
        FontAwesomeBrands::register(\Yii::$app->getView());
        return [
            'username',
            'email',
            ['attribute' => 'created_at', 'value' => function($m) { return date('H:i d/m/Y', $m->created_at); }],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['class' => 'actionIcons'],/* add class to <td> of action icons */
                'template' => '<div class="icoBox">{details} {toggle} {delete}</div>',
                'buttons' => [
                    'details' => function ($url, $model) {
                        $options = [
                            'class' => 'col-md-2',
                            'title' => 'User details',
                            'aria-label' => 'User details',
                            'id' => 'user_details_' . $model->id,
                        ];
                        return Html::a('<i class="fas fa-edit"></i>', $url, $options);
                    },
                    'toggle' => function($url, $model) {
                        $options = [
                            'class' => 'col-md-2',
                            'title' => 'User toggle status',
                            'aria-label' => 'User toggle status',
                            'id' => 'user_toggle_' . $model->id,
                        ];
                        return Html::a('<i class="fas fa-' . ($model->status === 1?'check-circle':'ban') . '"></i>', $url, $options);
                    },
                    'delete' => function ($url, $model) {
                        $options = [
                            'class' => 'col-md-2',
                            'title' => 'User delete',
                            'aria-label' => 'User delete',
                            'id' => 'user_delete_' . $model->id,
                            'onclick' => 'confirmModal({"id":"confirm_modal"}).done(function() { 
                                window.location = $(this).attr("href"); 
                            }.bind(this)); return false;'
                        ];
                        return Html::a('<i class="fas fa-trash"></i>', $url, $options);
                    },
                ]
            ]
        ];
    }
}
