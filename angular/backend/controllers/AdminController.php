<?php


namespace app\controllers;


use app\models\LoginForm;
use app\models\Products;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'login', 'index','dashboard'],
                'rules' => [
                    [
                        'actions' => ['logout', 'dashboard'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    ['actions' => ['index'], 'allow' => true, 'roles' => []]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return \Yii::$app->response->redirect(\Yii::$app->user->isGuest?['/admin/login']: ['/admin/dashboard']);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionDashboard()
    {

        return $this->render(
            'dashboard',
            [
                'activeUsers' => \Yii::createObject([
                    'class' => ActiveDataProvider::class,
                    'query' => User::find()->where('auth_key is not null')->andWhere(['>', 'auth_key_last_use', time() - 1800])
                ]),
                'products' => \Yii::createObject([
                    'class' => ActiveDataProvider::class,
                    'query' => Products::find()->orderBy(['status' => SORT_ASC])
                ]),
            ]
        );
    }
}