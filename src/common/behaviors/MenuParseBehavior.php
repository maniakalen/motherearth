<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 06/02/2019
 * Time: 22:02
 */

namespace common\behaviors;


use yii\base\Behavior;
use yii\web\Application;

class MenuParseBehavior extends Behavior
{
    public function events()
    {
        return [
            Application::EVENT_BEFORE_REQUEST => 'parseMenu'
        ];
    }

    public function parseMenu($event)
    {
        $menuItems = \Yii::$app->params['menuItems'];
        foreach ($menuItems as &$item) {
            foreach ($item as &$element) {
                if (is_callable($element)) {
                    $element = call_user_func($element);
                }
            }
        }
        \Yii::$app->params['menuItems'] = $menuItems;
    }
}