<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 2/23/2019
 * Time: 11:20 PM
 */

namespace frontend\controllers;


use common\models\Products;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['search'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['add'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['post'],
                ],
            ],
        ];
    }

    public function actionSearch($name)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $list = [];
        foreach (Products::find()->where(['like', 'name', $name])->all() as $product) {
            $list[] = ['id' => $product->id, 'value' => $product->name];
        }
        return $list;
    }

    public function actionAdd($name)
    {
        $product = \Yii::createObject(['class' => Products::className(), 'name' => $name]);
        return $product->save();
    }
}