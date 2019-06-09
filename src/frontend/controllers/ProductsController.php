<?php
/**
 * Created by PhpStorm.
 * User: Neli
 * Date: 2/23/2019
 * Time: 11:20 PM
 */

namespace frontend\controllers;


use common\models\Products;
use common\models\UserProducts;
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
                        'roles' => [],
                    ],
                    [
                        'actions' => ['add', 'add-to-current-user', 'load-user-products'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add' => ['post'],
                    'add-to-current-user' => ['post'],
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

    public function actionAdd()
    {
        $post = \Yii::$app->request->post();
        $product = \Yii::createObject(['class' => Products::className(), 'name' => $post['name']]);
        return $product->save()?$product->id:0;
    }

    public function actionAddToCurrentUser()
    {
        $post = \Yii::$app->request->post();
        $uid = \Yii::$app->user->id;

        $userProduct = \Yii::createObject(['class' => UserProducts::className(), 'user_id' => $uid, 'product_id' => $post['pid']]);
        return $userProduct->save()?$userProduct->id:0;
    }

    public function actionLoadUserProducts()
    {
        return $this->renderAjax('links_list', ['products' => ArrayHelper::map(\Yii::$app->user->identity->products, 'id', 'name')]);
    }
}