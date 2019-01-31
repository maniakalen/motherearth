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
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
        $this->createTable('{{%m_workflow}}', [
            'id' => $this->primaryKey(),
            'url_route' => $this->string(45)->notNull(),
            'name' => $this->string(255),
            'description' => $this->string()(),
            'status' => $this->integer(1),
            'auto_transit' => $this->integer(1),
            'layout' => $this->string(255),
        ], $tableOptions);

            // creates index
    $this->createIndex(
    'idx_status_workflow',
    '{{%m_workflow}}',
    ['status'],
    false    );
        // creates index
    $this->createIndex(
    'idx_route_search_workflow',
    '{{%m_workflow}}',
    ['url_route'],
    false    );
        // creates index
    $this->createIndex(
    'idx_auto_transit_workflow',
    '{{%m_workflow}}',
    ['auto_transit'],
    false    );
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
            // creates index
    $this->dropIndex(
    'idx_status_workflow',
    '{{%m_workflow}}'
    );
        // creates index
    $this->dropIndex(
    'idx_route_search_workflow',
    '{{%m_workflow}}'
    );
        // creates index
    $this->dropIndex(
    'idx_auto_transit_workflow',
    '{{%m_workflow}}'
    );
$this->dropTable('{{%m_workflow}}');
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
