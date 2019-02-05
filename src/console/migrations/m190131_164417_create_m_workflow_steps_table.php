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

        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->batchInsert(
        '{{%m_workflow_steps}}',
        ['id','workflow_id','parent_id','url_route','service_class','name','next_step_id','status','auth_item_name','prev_step_id'],
        [
            ['1','1',NULL,'general','{"class":"frontend\\\\workflows\\\\signup\\\\steps\\\\services\\\\General","view":"general"}','General data',NULL,'1','',NULL],
            ['2','1',NULL,'location','{"class":"frontend\\\\workflows\\\\signup\\\\steps\\\\services\\\\Location","view":"location"}','Location data',NULL,'1','','1'],
            ['3','1',NULL,'production','{"class":"frontend\\\\workflows\\\\signup\\\\steps\\\\services\\\\Production","view":"production"}','Production data',NULL,'1','','2'],
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
            $this->delete('{{%m_workflow_steps}}', ['in', 'id', [1,2,3]]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
