<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 2/23/2019
 * Time: 11:11 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class ProductsSignupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = [
        'js/products_signup.js'
    ];
    public $depends = [
        'frontend\assets\BloodhoundAsset',
        'frontend\assets\SignupAsset'
    ];
}