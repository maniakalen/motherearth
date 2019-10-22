<?php


namespace app\behavior;


use yii\base\Behavior;
use yii\web\User;
use yii\web\UserEvent;

class UserRestBehavior extends Behavior
{
    public function events()
    {
        return [
            User::EVENT_BEFORE_LOGIN => 'beforeUserLogin'
        ];
    }

    public function beforeUserLogin(UserEvent $event)
    {
        $identity = $event->identity;
        $identity->auth_key_last_use = time();
        $event->isValid = $identity->save();
    }
}