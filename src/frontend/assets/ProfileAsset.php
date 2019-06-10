<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class ProfileAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/profile.css'
    ];
    public $js = [
        'js/profile.js'
    ];
    public $depends = [
        '\frontend\assets\StylesAsset'
    ];
}