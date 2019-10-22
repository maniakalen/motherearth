<?php


namespace app\controllers;


use app\models\User;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class LoginController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'login'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        $data = json_decode(\Yii::$app->request->rawBody, true);

        $identity = User::findByUsername($data['username']);
        if ($identity && $identity->validatePassword($data['password'])) {
            $identity->auth_key = md5(time() . $data['password']);
            $identity->auth_key_last_use = $identity->updated_at = time();
            if ($identity->save()) {
                return json_encode(['hash' => $identity->auth_key, 'permissions' => $identity->permissions]);
            }
        }
        \Yii::$app->response->statusCode = 500;
        \Yii::$app->response->statusText = Response::$httpStatuses[500];
        return false;
    }

    public function actionLogout()
    {
        $identity = \Yii::$app->user->identity;
        $identity->auth_key = null;
        if ($identity->save()) {
            return true;
        }
        \Yii::$app->response->statusCode = 500;
        \Yii::$app->response->statusText = Response::$httpStatuses[500];
        return false;
    }

    public function afterAction($action, $result)
    {
        \Yii::$app->response->headers->add('Access-Control-Allow-Origin', '*');
        \Yii::$app->response->headers->add('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding');
        \Yii::$app->response->headers->add('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS');

        return parent::afterAction($action, $result);
    }
}