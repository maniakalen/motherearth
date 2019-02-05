<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 9:52 AM
 */

namespace frontend\workflows\signup\steps\services;


use common\models\GeoUnits;
use frontend\models\SignupForm;
use yii\base\View;

class Location extends SignupStepServiceAbstract
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
            'scenario' => SignupForm::SCENARIO_LOCATION
        ]);
        if (($data = \Yii::$app->session->removeFlash($model->formName()))) {
            $model->load(unserialize($data[0]));
        }
        if (($data = \Yii::$app->session->removeFlash($model->formName() . '_errors'))) {
            $model->addErrors(unserialize($data[0]));
        }
        return $view->render($this->view, ['model' => $model, 'step' => $this->getStep()], $this);
    }

}