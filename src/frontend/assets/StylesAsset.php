<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 21/01/2019
 * Time: 11:26
 */

namespace frontend\assets;


use yii\web\AssetBundle;

class StylesAsset extends AssetBundle
{
    public $depends = [
        'AppAsset',
    ];
}