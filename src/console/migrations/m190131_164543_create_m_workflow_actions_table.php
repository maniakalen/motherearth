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
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
        $this->createTable('{{%m_workflow_actions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'type' => $this->enum('a','input','button'),
            'styles' => $this->string()(),
            'service_class' => $this->string(255)->notNull(),
            'status' => $this->integer(1),
        ], $tableOptions);

            // creates index
    $this->createIndex(
    'idx_wf_actions_status',
    '{{%m_workflow_actions}}',
    ['status'],
    false    );
        // creates index
    $this->createIndex(
    'idx_wf_actions_type',
    '{{%m_workflow_actions}}',
    ['type'],
    false    );
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->batchInsert(
        '{{%m_workflow_actions}}',
        ['id','name','type','styles','service_class','status'],
        [
        		['1','Continue','input','{\"type\":\"submit\", \"class\":\"btn btn-primary pull-right\", \"valueTemp\": \"[value]\"}','{\"class\":\"frontend\\\\workflows\\\\signup\\\\actions\\\\Save\"}','1'],
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
    'idx_wf_actions_status',
    '{{%m_workflow_actions}}'
    );
        // creates index
    $this->dropIndex(
    'idx_wf_actions_type',
    '{{%m_workflow_actions}}'
    );
$this->dropTable('{{%m_workflow_actions}}');
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
