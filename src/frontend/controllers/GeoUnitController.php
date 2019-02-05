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
                        'actions' => ['search-counties-list','search-cities-list', 'search-coords', 'register', 'search-unit'],
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

        $type = isset($post['MatchLevel'])?$post['MatchLevel']:'city';
        $match = ucfirst($type);
        $name = isset($post['Location']) &&
                isset($post['Location']['Address']) &&
                isset($post['Location']['Address'][$match])?$post['Location']['Address'][$match]:null;
        $lat = isset($post['Location']) &&
                isset($post['Location']['DisplayPosition']) &&
                isset($post['Location']['DisplayPosition']['Latitude'])?$post['Location']['DisplayPosition']['Latitude']:null;

        $lon = isset($post['Location']) &&
                isset($post['Location']['DisplayPosition']) &&
                isset($post['Location']['DisplayPosition']['Longitude'])?$post['Location']['DisplayPosition']['Longitude']:null;

        if ($id = \Yii::$app->geounits->registerGeoUnit($type, $name, $lat, $lon)) {
            $county = isset($post['Location']) &&
                    isset($post['Location']['Address']) &&
                    isset($post['Location']['Address']['County'])?$post['Location']['Address']['County']:null;

            if (!GeoUnits::find()->where(['type' => GeoUnitsInterface::TYPE_COUNTY, 'name' => $name])->one()) {
                $countyData = \Yii::$app->location->searchGeoUnit($county, ['country' => 'BGR', 'county' => $county]);
                if (is_string($countyData)) {
                    $countyData = json_decode($countyData, JSON_UNESCAPED_UNICODE);
                    $countyData = $countyData['Response']['View'][0]['Result'][0];
                }

                $type = GeoUnitsInterface::TYPE_COUNTY;
                $match = ucfirst($type);
                $name = isset($countyData['Location']) &&
                        isset($countyData['Location']['Address']) &&
                        isset($countyData['Location']['Address'][$match])?
                    $countyData['Location']['Address'][$match]:
                    null;

                if ($countyData['MatchQuality']['County'] === 1
                    && $name === $countyData['Location']['Address']['City']) {

                    $lat = isset($countyData['Location']) &&
                           isset($countyData['Location']['DisplayPosition']) &&
                           isset($countyData['Location']['DisplayPosition']['Latitude']) ?
                        $countyData['Location']['DisplayPosition']['Latitude'] :
                        null;

                    $lon = isset($countyData['Location']) &&
                           isset($countyData['Location']['DisplayPosition']) &&
                           isset($countyData['Location']['DisplayPosition']['Longitude']) ?
                        $countyData['Location']['DisplayPosition']['Longitude'] :
                        null;

                    \Yii::$app->geounits->registerGeoUnit($type, $name, $lat, $lon);
                }
            }

            return $id;
        }

    }

    public function actionSearchCitiesList($unit, $county = null, $city = null, $district = null)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $params = ['country' => 'BGR'];
        if ($county) {
            $params = ArrayHelper::merge($params, ['county' => $county]);
        }
        if ($city) {
            $params = ArrayHelper::merge($params, ['city' => $city]);
        }
        if ($district) {
            $params = ArrayHelper::merge($params, ['district' => $district]);
        }
        $data = json_decode(\Yii::$app->location->searchGeoUnit($unit, $params), JSON_UNESCAPED_UNICODE);
        if (!isset($data['Response'])
            || !isset($data['Response']['View'])
            || !isset($data['Response']['View'][0])
            || !isset($data['Response']['View'][0]['Result'])) {

            return [];
        }
        $data = $data['Response']['View'][0]['Result'];
        $list = [];
        $geoUnitType = [GeoUnitsInterface::TYPE_CITY, GeoUnitsInterface::TYPE_COUNTY, GeoUnitsInterface::TYPE_DISTRICT];
        foreach ($data as $k => $item) {
            if (in_array($item['MatchLevel'], $geoUnitType)) {
                $nameItem = ucfirst($item['MatchLevel']);
                $list[] = [
                    'id' => $k,
                    'value' => $item['Location']['Address'][$nameItem],
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
        $r = \Yii::$app->geounits->searchByCoords($lat, $lon);
        if (isset($r['Response']) && isset($r['Response']['View'])
            && isset($r['Response']['View'][0]) && isset($r['Response']['View'][0]['Result'])) {
            \Yii::$app->geounits->populateMissingUnits($r['Response']['View'][0]['Result']);
        }

    }
}