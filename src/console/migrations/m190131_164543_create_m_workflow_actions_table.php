<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%m_workflow_actions}}`.
 */
class m190131_164543_create_m_workflow_actions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {

            $this->execute('SET FOREIGN_KEY_CHECKS = 0');
            $this->batchInsert(
            '{{%m_workflow_actions}}',
            ['id','name','type','styles','service_class','status'],
            [
                    ['1','Continue','input','{"type":"submit", "class":"btn btn-primary pull-right", "valueTemp": "[value]"}','{"class":"frontend\\\\workflows\\\\signup\\\\actions\\\\Save"}','1'],
            ]);
            $this->execute('SET FOREIGN_KEY_CHECKS = 1');
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        try {

            $this->delete('{{%m_workflow_actions}}', ['id' => 1]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
