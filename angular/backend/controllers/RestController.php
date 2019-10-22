<?php


namespace app\controllers;

use yii\filters\AccessControl;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class RestController extends ActiveController
{

    /**
     * Behaviors definition for the controller
     *
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBearerAuth::class,
            ],
        ];
        $behaviors['access'] = [
            'class' => AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['can'],
                    'allow' => true,
                    'roles' => [],
                ]
            ]
        ];
        return $behaviors;
    }

    /**
     * Checks the privilege of the current user.
     *
     * This method should be overridden to check whether the current user has the privilege
     * to run the specified action against the specified data model.
     * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
     *
     * @param string $action the ID of the action to be executed
     * @param \yii\base\Model $model the model to be accessed. If `null`, it means no specific model is being accessed.
     * @param array $params additional parameters
     * @throws ForbiddenHttpException if the user does not have access
     */
    public function checkAccess($action, $model = null, $params = [])
    {
        // check if the user can access $action and $model
        // throw ForbiddenHttpException if access should be denied
        if ($action === 'update' || $action === 'delete') {
            if ($model->author_id !== \Yii::$app->user->id)
                throw new ForbiddenHttpException(sprintf('You can only %s articles that you\'ve created.', $action));
        }
    }

    public function actionCan($permission)
    {
        return json_encode(['status' => \Yii::$app->user->can($permission)]);
    }
}