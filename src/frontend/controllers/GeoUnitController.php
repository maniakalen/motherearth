<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 02/02/2019
 * Time: 19:34
 */

namespace frontend\controllers;


use common\interfaces\GeoUnitsInterface;
use common\models\GeoUnits;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
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
                        'actions' => ['search-counties-list','search-cities-list', 'search-coords', 'register', 'search-unit', 'search-address'],
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

        return \Yii::$app->geounits->registerUnits($post, 'Street');
    }

    public function actionSearchUnit($lat, $lon)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $r = \Yii::$app->geounits->searchByCoords($lat, $lon);
        if (isset($r['Response']) && isset($r['Response']['View'])
            && isset($r['Response']['View'][0]) && isset($r['Response']['View'][0]['Result'])) {
            \Yii::$app->geounits->populateMissingUnits($r['Response']['View'][0]['Result']);
            $data = reset($r['Response']['View'][0]['Result']);
            $result = ['Address' => $data['Location']['Address'], 'Coords' => $data['Location']['DisplayPosition']];


            return $result;
        }

        return null;
    }

    public function actionSearchAddress($address)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $params = ['country' => 'BGR', 'maxresults' => 25];
        $data = json_decode(\Yii::$app->location->searchGeoUnit($address, $params), JSON_UNESCAPED_UNICODE);
        if ($data) {
            $data = $data['Response']['View'][0]['Result'];
            $list = [];
            foreach ($data as $k => $item) {
                $list[] = ['id' => $k, 'value' => $item['Location']['Address']['Label'], 'data' => $item];
            }

            return $list;
        }

        return [];
    }
}