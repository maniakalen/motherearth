<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 9:53 AM
 */

namespace frontend\workflows\signup\steps\services;


use frontend\models\SignupForm;
use maniakalen\workflow\interfaces\StepServiceInterface;
use yii\base\View;

class Production extends SignupStepServiceAbstract
{
    /**
     * @param array $get
     *
     * @return
     * @throws \yii\base\InvalidConfigException
     */
    public function render(View $view)
    {
        $model = \Yii::createObject([
            'class' => SignupForm::className(),
            'scenario' => SignupForm::SCENARIO_PRODUCTS
        ]);
        if (($data = \Yii::$app->session->removeFlash($model->formName()))) {
            $model->load(unserialize($data[0]), '');
        }
        if (($data = \Yii::$app->session->removeFlash($model->formName() . '_errors'))) {
            $model->addErrors(unserialize($data[0]));
        }
        if (!$model->user_id) {
            //throw new BadRequestHttpException("Missing fundamental data");
        }
        return $view->render($this->view, ['model' => $model, 'step' => $this->getStep()], $this);
    }

    public function save()
    {
        /** @var SignupForm $model */
        $model = \Yii::createObject([
            'class' => SignupForm::className(),
            'scenario' => SignupForm::SCENARIO_PRODUCTS
        ]);
        if ($model->load($this->post) && ($user = $model->signup())) {
            $next = $this->step->nextStep;
            $workflow = $this->step->workflow;
            if ($next) {
                \Yii::$app->session->addFlash($model->formName(), serialize(['user_id' => $user->id]));
                return \Yii::$app->response->redirect([
                    'workflow/workflow/render',
                    'wf_url' => $workflow->url_route,
                    'step_url' => $next->url_route
                ]);
            } else {
                if (\Yii::$app->getUser()->login($user)) {
                    return \Yii::$app->getResponse()->redirect(\Yii::$app->getHomeUrl());
                }
            }
        } else {
            \Yii::$app->session->addFlash($model->formName(), serialize($this->post));
            \Yii::$app->session->addFlash($model->formName() . '_errors', serialize($model->errors));
            return \Yii::$app->response->refresh();
        }
    }
}