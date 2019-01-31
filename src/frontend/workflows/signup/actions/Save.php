<?php
/**
 * Created by PhpStorm.
 * User: peter.georgiev
 * Date: 1/31/2019
 * Time: 2:07 PM
 */

namespace frontend\workflows\signup\actions;


use frontend\workflows\signup\interfaces\SaveActionInterface;
use maniakalen\workflow\interfaces\ActionServiceInterface;
use maniakalen\workflow\interfaces\StepServiceInterface;

class Save implements ActionServiceInterface
{
    private $callback;
    public function setCallback($callback)
    {
        $this->callback = $callback;
        return $this;
    }

    public function process(StepServiceInterface $step)
    {
        if ($step instanceof SaveActionInterface) {
            return $step->save();
        }

        return false;
    }
}