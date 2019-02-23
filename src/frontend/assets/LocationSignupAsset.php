<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 2/23/2019
 * Time: 11:13 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class LocationSignupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/signup.js'
    ];
    public $depends = [
        'frontend\assets\SignupAsset'
    ];
}