<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%m_workflow_steps}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%m_workflow}}`
 * - `{{%m_workflow_steps}}`
 */
class m190131_164417_create_m_workflow_steps_table extends Migration
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
        $this->createTable('{{%m_workflow_steps}}', [
            'id' => $this->primaryKey(),
            'workflow_id' => $this->integer(11)->notNull(),
            'parent_id' => $this->integer(11),
            'url_route' => $this->string(45)->notNull(),
            'service_class' => $this->string(255)->notNull(),
            'name' => $this->string(255),
            'next_step_id' => $this->integer(11),
            'status' => $this->integer(1),
            'auth_item_name' => $this->string(64),
            'prev_step_id' => $this->integer(11),
        ], $tableOptions);

            // creates index
    $this->createIndex(
    'idx_fk_workflow_steps_parent_id',
    '{{%m_workflow_steps}}',
    ['parent_id'],
    false    );
        // creates index
    $this->createIndex(
    'idx_uq_workflow_steps_order_idx',
    '{{%m_workflow_steps}}',
    ['workflow_id','parent_id'],
    true    );
        // creates index
    $this->createIndex(
    'idx_route_search_workflow_step',
    '{{%m_workflow_steps}}',
    ['url_route'],
    false    );
        // creates index
    $this->createIndex(
    'idx_status_workflow_steps',
    '{{%m_workflow_steps}}',
    ['status'],
    false    );

        // add foreign key for table `{{%m_workflow}}`
        $this->addForeignKey(
            '{{%fk-m_workflow_steps-workflow_id}}',
            '{{%m_workflow_steps}}',
            'workflow_id',
            '{{%m_workflow}}',
            'id',
            'CASCADE'
        );

        // add foreign key for table `{{%m_workflow_steps}}`
        $this->addForeignKey(
            '{{%fk-m_workflow_steps-parent_id}}',
            '{{%m_workflow_steps}}',
            'parent_id',
            '{{%m_workflow_steps}}',
            'id',
            'CASCADE'
        );
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->batchInsert(
        '{{%m_workflow_steps}}',
        ['id','workflow_id','parent_id','url_route','service_class','name','next_step_id','status','auth_item_name','prev_step_id'],
        [
        		['1','1',NULL,'general','{\"class\":\"frontend\\\\workflows\\\\signup\\\\steps\\\\services\\\\General\",\"view\":\"general\"}','General data',NULL,'1','',NULL],
		['2','1',NULL,'location','{\"class\":\"frontend\\\\workflows\\\\signup\\\\steps\\\\services\\\\Location\",\"view\":\"location\"}','Location data',NULL,'1','','1'],
		['3','1',NULL,'production','{\"class\":\"frontend\\\\workflows\\\\signup\\\\steps\\\\services\\\\Production\",\"view\":\"production\"}','Production data',NULL,'1','','2'],
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
        // drops foreign key for table `{{%m_workflow}}`
        $this->dropForeignKey(
            '{{%fk-m_workflow_steps-workflow_id}}',
            '{{%m_workflow_steps}}'
        );
        // drops foreign key for table `{{%m_workflow_steps}}`
        $this->dropForeignKey(
            '{{%fk-m_workflow_steps-parent_id}}',
            '{{%m_workflow_steps}}'
        );
            // creates index
    $this->dropIndex(
    'idx_fk_workflow_steps_parent_id',
    '{{%m_workflow_steps}}'
    );
        // creates index
    $this->dropIndex(
    'idx_uq_workflow_steps_order_idx',
    '{{%m_workflow_steps}}'
    );
        // creates index
    $this->dropIndex(
    'idx_route_search_workflow_step',
    '{{%m_workflow_steps}}'
    );
        // creates index
    $this->dropIndex(
    'idx_status_workflow_steps',
    '{{%m_workflow_steps}}'
    );
$this->dropTable('{{%m_workflow_steps}}');
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
