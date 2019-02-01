<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 2/1/2019
 * Time: 8:37 AM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class LeafletSignupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = ['js/leaflet_signup.js'];
}