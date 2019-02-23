<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 12:05 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class SignupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/signup.css'
    ];
    public $depends = [
        'frontend\assets\AppAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];
}