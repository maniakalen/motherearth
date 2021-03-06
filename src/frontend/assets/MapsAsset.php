<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 21/01/2019
 * Time: 11:52
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class MapsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/maps_init.js'
    ];
    public $css = [
        'css/leaflet.css',
        'css/styles.css'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}