<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 11:11 AM
 */

namespace frontend\workflows\signup\steps\services;

use maniakalen\workflow\models\WorkflowSteps;
use Yii;
use maniakalen\workflow\interfaces\StepServiceInterface;
use yii\base\InvalidArgumentException;

abstract class SignupStepServiceAbstract implements StepServiceInterface
{
    protected $step;
    protected $get;
    protected $post;
    public $view;
    public function setGetRequestParams(array $params)
    {
        $this->get = $params;
    }

    public function setPostRequestParams(array $params)
    {
        $this->post = $params;
    }

    public function getStep()
    {
        return $this->step;
    }

    public function setStep($step)
    {
        if (!($step instanceof WorkflowSteps)) {
            throw new InvalidArgumentException("Provided argument not supported");
        }
        $this->step = $step;
        return $this;
    }
    /**
     * @return string the view path that may be prefixed to a relative view name.
     */
    public function getViewPath()
    {
        return Yii::getAlias('@app/workflows/signup/views');
    }
}