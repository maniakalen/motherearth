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