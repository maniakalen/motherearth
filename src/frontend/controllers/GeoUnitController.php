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
                        'actions' => ['search-counties-list','search-cities-list', 'search-coords', 'register'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'register' => ['post'],
                ],
            ],

        ];
    }
    public function actionRegister()
    {
        $post = \Yii::$app->request->post();
        $name = isset($post['Location']) &&
                isset($post['Location']['Address']) &&
                isset($post['Location']['Address']['City'])?$post['Location']['Address']['City']:null;
        $type = isset($post['MatchLevel'])?$post['MatchLevel']:'city';

        $lat = isset($post['Location']) &&
                isset($post['Location']['DisplayPosition']) &&
                isset($post['Location']['DisplayPosition']['Latitude'])?$post['Location']['DisplayPosition']['Latitude']:null;

        $lon = isset($post['Location']) &&
                isset($post['Location']['DisplayPosition']) &&
                isset($post['Location']['DisplayPosition']['Longitude'])?$post['Location']['DisplayPosition']['Longitude']:null;

        if ($id = \Yii::$app->geounits->registerGeoUnit($type, $name, $lat, $lon)) {
            $county = isset($post['Location']) &&
                    isset($post['Location']['Address']) &&
                    isset($post['Location']['Address']['county'])?$post['Location']['Address']['county']:null;

            if ($name !== $county) {
                $county = \Yii::$app->location->getGeoUnitCoords($county);
                print_r($county); die();
            }
        }

    }

    public function actionSearchCitiesList($unit)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = json_decode(\Yii::$app->location->searchGeoUnit($unit), JSON_UNESCAPED_UNICODE);
        $data = $data['Response']['View'][0]['Result'];
        $list = [];
        foreach ($data as $k => $item) {
            if ($item['MatchLevel'] === 'city') {
                $list[] = [
                    'id' => $k,
                    'value' => $item['Location']['Address']['City'] . ', ' . $item['Location']['Address']['County'],
                    'data' => $item];
            }
        }
        return $list;
    }

    public function actionSearchCountiesList($unit)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $data = json_decode(\Yii::$app->location->searchGeoUnit($unit), JSON_UNESCAPED_UNICODE);
        $data = $data['Response']['View'][0]['Result'];
        $list = [];
        foreach ($data as $k => $item) {
            if (isset($item['Location']['Address']['County']) && $item['Location']['Address']['County'] === $unit) {
                $list[] = ['id' => $k, 'value' => $item['Location']['Address']['County'], 'data' => $item];
            }
        }
        return $list;
    }
    public function actionSearchUnit($lat, $lon)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return \Yii::$app->geounits->searchByCoords($lat, $lon);
    }
}