<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 3/6/2019
 * Time: 8:18 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/login.css'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}