<?php
namespace app\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_item}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%auth_rule}}`
 */
class m190131_164447_create_auth_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {

            $this->execute('SET FOREIGN_KEY_CHECKS = 0');
            $this->batchInsert(
            '{{%auth_item}}',
            ['name','type','description','rule_name','data','created_at','updated_at'],
            [
                ['super_admin','1','The Allmighty',NULL,NULL,NULL,NULL],
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
            $this->delete('{{%auth_item}}', ['in', 'name', ['super_admin']]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
