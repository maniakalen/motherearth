<?php


namespace app\assets;


use yii\web\AssetBundle;

class FontAwesomeBrands extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'fa/css/solid.min.css',
        'fa/css/fontawesome.min.css',
    ];
}