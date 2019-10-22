<?php


namespace app\models;


use maniakalen\admingui\components\ModelManager;
use maniakalen\admingui\exceptions\GuiException;

class UserModelManager extends ModelManager
{
    /**
     * @param array $post
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public function createRecord(array $post)
    {
        $post['User']['created_at'] = time();
        return parent::createRecord($post);
    }

    /**
     * @param $id
     * @return mixed
     * @throws GuiException
     */
    public function toggleRecordStatus($id)
    {
        $model = $this->model;
        $class = get_class($this->model);
        if (in_array('status', $model->attributes())) {
            $model = $model::findOne($id);
            $model->scenario = $class::SCENARIO_STATUS_TOGGLE;
            $model->status = !$model->status;
            if (!$model->save()) {
                \Yii::error("Scenario: " . $model->scenario);
                \Yii::error("Record errors: \n\t" . print_r($model->errors, 1));
                return false;
            }
            return true;
        }

        throw new GuiException("Model class does not support status toggle");
    }
}