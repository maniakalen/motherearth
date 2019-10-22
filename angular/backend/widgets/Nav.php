<?php


namespace app\widgets;


use yii\helpers\ArrayHelper;

class Nav extends \yii\bootstrap\Nav
{
    public function init()
    {
        parent::init();
        foreach ($this->items as &$item) {
            $visible = ArrayHelper::getValue($item, 'visible', null);
            if (is_callable($visible)) {
                $item['visible'] = call_user_func($visible, $item);
            }
        }
    }
}