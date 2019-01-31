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
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
        $this->createTable('{{%m_workflow_step_actions}}', [
            'id' => $this->primaryKey(),
            'workflow_step_id' => $this->integer(11),
            'workflow_action_id' => $this->integer(11),
            'auth_item_name' => $this->string(64),
            'name' => $this->string(255),
            'callback' => $this->string()(),
            'display_group' => $this->integer(11),
        ], $tableOptions);

            // creates index
    $this->createIndex(
    'idx_step_actions_uq',
    '{{%m_workflow_step_actions}}',
    ['workflow_step_id','workflow_action_id'],
    true    );
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->batchInsert(
        '{{%m_workflow_step_actions}}',
        ['id','workflow_step_id','workflow_action_id','auth_item_name','name','callback','display_group'],
        [
        		['1','1','1','','Continue','','1'],
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
            // creates index
    $this->dropIndex(
    'idx_step_actions_uq',
    '{{%m_workflow_step_actions}}'
    );
$this->dropTable('{{%m_workflow_step_actions}}');
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
