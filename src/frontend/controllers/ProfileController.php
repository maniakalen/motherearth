<?php


namespace frontend\controllers;


use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ProfileController extends Controller
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
                        'actions' => ['index', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $user = \Yii::$app->user->identity;

        return $this->render('edit', [
            'title' => $user->additionalData->name . '\'s profile',
            'user' => $user,
            'data' => $user->additionalData,
            'location' => $user->location,
            'products' => $user->products

        ]);
    }
}