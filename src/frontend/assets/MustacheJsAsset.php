<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 3/17/2019
 * Time: 2:00 PM
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class MustacheJsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $js = ['js/mustache.min.js'];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
}