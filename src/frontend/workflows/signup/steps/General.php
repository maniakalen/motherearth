<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/30/2019
 * Time: 3:34 PM
 */

namespace frontend\workflows\signup\steps;



use maniakalen\workflow\interfaces\StepServiceInterface;
use maniakalen\workflow\models\WorkflowSteps;
use yii\base\InvalidArgumentException;
use yii\base\View;

class General implements StepServiceInterface
{
    private $step;

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
     * @param array $get
     *
     * @return
     */
    public function render(View $view)
    {

    }

    /**
     * @return string the view path that may be prefixed to a relative view name.
     */
    public function getViewPath()
    {
        // TODO: Implement getViewPath() method.
}}