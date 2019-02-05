<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_assignment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%auth_item}}`
 */
class m190131_164517_create_auth_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
            $this->execute('SET FOREIGN_KEY_CHECKS = 0');
            $this->batchInsert(
            '{{%auth_assignment}}',
            ['item_name','user_id','created_at'],
            [
                ['super_admin','2','2147483647'],
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
            $this->delete('{{%auth_assignment}}', ['item_name' => 'super_admin', 'user_id' => 2]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
