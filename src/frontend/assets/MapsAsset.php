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
        ['https://unpkg.com/leaflet@1.4.0/dist/leaflet.js', 'integrity' => 'sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg==', 'crossorigin' => true],
        'js/maps_init.js'
    ];
    public $css = [
        'css/leaflet.css'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}