<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 02/02/2019
 * Time: 21:42
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class BloodhoundAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = ['js/typeahead.bundle.js'];
    public $css = ['css/bloodhound.css'];
    public $depends = [
        'frontend\assets\AppAsset'
    ];
}