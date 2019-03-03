<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 9:53 AM
 */

namespace frontend\workflows\signup\steps\services;


use frontend\models\SignupForm;
use frontend\workflows\signup\interfaces\SaveActionInterface;
use yii\base\InvalidArgumentException;
use yii\base\View;

class Production extends SignupStepServiceAbstract implements SaveActionInterface
{
    /**
     * @param array $get
     *
     * @return
     * @throws \yii\base\InvalidConfigException
     */
    public function render(View $view)
    {
        $ss = \Yii::$app->session;
        $model = \Yii::createObject([
            'class' => SignupForm::className(),
            'scenario' => SignupForm::SCENARIO_PRODUCTS
        ]);

        if (!$ss->has(SignupForm::SCENARIO_GENERAL) || !$ss->has(SignupForm::SCENARIO_LOCATION)) {
            throw new InvalidArgumentException('Missing signup data');
        }

        if (($data = $ss->removeFlash($model->formName() . '_errors'))) {
            $model->addErrors(unserialize($data[0]));
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