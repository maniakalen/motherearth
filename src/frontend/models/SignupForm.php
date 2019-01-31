<?php
namespace frontend\models;

use common\models\UserAdditionalData;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    const SCENARIO_GENERAL = 'general';
    const SCENARIO_LOCATION = 'location';
    const SCENARIO_PRODUCTS = 'products';

    public $username;
    public $email;
    public $password;
	public $phone;
	public $details;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim', 'on' => self::SCENARIO_GENERAL],
            ['username', 'required', 'on' => self::SCENARIO_GENERAL],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.', 'on' => self::SCENARIO_GENERAL],
            ['username', 'string', 'min' => 2, 'max' => 255, 'on' => self::SCENARIO_GENERAL],

            ['email', 'trim', 'on' => self::SCENARIO_GENERAL],
            ['email', 'required', 'on' => self::SCENARIO_GENERAL],
            ['email', 'email', 'on' => self::SCENARIO_GENERAL],
            ['email', 'string', 'max' => 255, 'on' => self::SCENARIO_GENERAL],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.', 'on' => self::SCENARIO_GENERAL],

            ['password', 'required', 'on' => self::SCENARIO_GENERAL],
            ['password', 'string', 'min' => 6, 'on' => self::SCENARIO_GENERAL],

	        ['phone', 'string', 'max' => 11, 'on' => self::SCENARIO_GENERAL],
	        ['details', 'string', 'on' => self::SCENARIO_GENERAL],

            []

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        if (method_exists($this, $this->scenario)) {
            return call_user_func([$this, $this->scenario]);
        }

        return null;
    }

    public function general()
    {
        $user = \Yii::createObject(['class' => 'common\models\User']);
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            /** @var UserAdditionalData $userData */
            $userData = \Yii::createObject(['class' => 'common\models\UserAdditionalData', 'user_id' => $user->id]);
            $userData->phone = $this->phone;
            $userData->details = $this->details;
            return $userData->save()?$user:null;
        }

        return null;

    }


}
