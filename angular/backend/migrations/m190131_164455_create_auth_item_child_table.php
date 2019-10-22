<?php
namespace app\migrations;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%auth_item_child}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%auth_item}}`
 * - `{{%auth_item}}`
 */
class m190131_164455_create_auth_item_child_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {
            $tableOptions = null;
            $this->execute('SET FOREIGN_KEY_CHECKS = 0');
            $this->batchInsert(
            '{{%auth_item_child}}',
            ['parent','child'],
            [
                ['super_admin','maniakalen/workflow/delete'],
                ['super_admin','maniakalen/workflow/edit'],
                ['super_admin','maniakalen/workflow/view'],
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
        $this->delete('{{%auth_item_child}}',['in', 'child', ['maniakalen/workflow/delete', 'maniakalen/workflow/edit', 'maniakalen/workflow/view']]);

        return true;
    }
}
