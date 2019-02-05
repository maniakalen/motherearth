<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%m_workflow}}`.
 */
class m190131_164405_create_m_workflow_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->batchInsert(
        '{{%m_workflow}}',
        ['id','url_route','name','description','status','auto_transit','layout'],
        [
        		['1','signup','Signup','Signup workflow','1','1','@app/views/layouts/index'],
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
            $this->delete('{{%m_workflow}}', ['id' => 1]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
