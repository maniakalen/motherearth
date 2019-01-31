<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 9:52 AM
 */

namespace frontend\workflows\signup\steps\services;


use frontend\models\SignupForm;
use maniakalen\workflow\interfaces\StepServiceInterface;
use yii\base\View;

class Location extends SignupStepServiceAbstract
{

    public function setGetRequestParams(array $params)
    {
        // TODO: Implement setGetRequestParams() method.
    }

    public function setPostRequestParams(array $params)
    {
        // TODO: Implement setPostRequestParams() method.
    }

    public function getStep()
    {
        // TODO: Implement getStep() method.
    }

    public function setStep($step)
    {
        // TODO: Implement setStep() method.
    }

    /**
     * @param array $get
     *
     * @return
     */
    public function render(View $view)
    {
        $model = \Yii::createObject(SignupForm::className());
        if (($data = \Yii::$app->session->removeFlash($model->formName()))) {
            $model->load(unserialize($data[0]));
        }
        if (($data = \Yii::$app->session->removeFlash($model->formName() . '_errors'))) {
            $model->addErrors(unserialize($data[0]));
        }
        return $view->render($this->view, ['model' => $model, 'step' => $this->getStep()], $this);
    }

}