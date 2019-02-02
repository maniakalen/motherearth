<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 02/02/2019
 * Time: 19:34
 */

namespace frontend\controllers;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class GeoUnitController extends Controller
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
                        'actions' => ['search-unit', 'search-coords'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ]
        ];
    }


    public function actionSearchCoords($unit)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return \Yii::$app->geounits->searchGeoUnit($unit);
    }

    public function actionSearchUnit($lat, $lon)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return \Yii::$app->geounits->searchByCoords($lat, $lon);
    }
}