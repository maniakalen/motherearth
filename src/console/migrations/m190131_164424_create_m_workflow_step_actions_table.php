<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%m_workflow_step_actions}}`.
 */
class m190131_164424_create_m_workflow_step_actions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
            $this->execute('SET FOREIGN_KEY_CHECKS = 0');
            $this->batchInsert(
                '{{%m_workflow_step_actions}}',
                ['id','workflow_step_id','workflow_action_id','auth_item_name','name','callback','display_group'],
                [
                    ['1','1','1','','Continue','','1'],
                    ['2','2','1','','Continue','','1'],
                    ['3','3','1','','Continue','','1'],
                ]
            );
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
            $this->delete('{{%m_workflow_step_actions}}', ['id' => 1]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
