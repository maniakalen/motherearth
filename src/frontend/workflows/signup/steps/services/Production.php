<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 9:53 AM
 */

namespace frontend\workflows\signup\steps\services;


use maniakalen\workflow\interfaces\StepServiceInterface;
use yii\base\View;

class Production extends SignupStepServiceAbstract
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
        return 'wow2';
    }
}