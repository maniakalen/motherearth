<?php


namespace app\widgets;


use yii\bootstrap\Html;

class NavBar extends \yii\bootstrap\NavBar
{
    public $toggleButton = false;
    /**
     * Renders collapsible toggle button.
     * @return string the rendering toggle button.
     */
    protected function renderToggleButton()
    {
        if ($this->toggleButton) {
            $bar = Html::tag('span', '', ['class' => 'icon-bar']);
            $screenReader = "<span class=\"sr-only\">{$this->screenReaderToggleText}</span>";

            return Html::button("{$screenReader}\n{$bar}\n{$bar}\n{$bar}", [
                'class' => 'navbar-toggle',
                'data-toggle' => 'collapse',
                'data-target' => "#{$this->containerOptions['id']}",
            ]);
        }
        return '';
    }
}