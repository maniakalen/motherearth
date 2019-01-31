<?php

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
            if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
        $this->createTable('{{%auth_item_child}}', [
            'parent' => $this->primaryKey(),
            'child' => $this->primaryKey(),
        ], $tableOptions);

            // creates index
    $this->createIndex(
    'child',
    '{{%auth_item_child}}',
    ['child'],
    false    );

        // add foreign key for table `{{%auth_item}}`
        $this->addForeignKey(
            '{{%fk-auth_item_child-parent}}',
            '{{%auth_item_child}}',
            'parent',
            '{{%auth_item}}',
            'name',
            'CASCADE'
        );

        // add foreign key for table `{{%auth_item}}`
        $this->addForeignKey(
            '{{%fk-auth_item_child-child}}',
            '{{%auth_item_child}}',
            'child',
            '{{%auth_item}}',
            'name',
            'CASCADE'
        );
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
        try {
        // drops foreign key for table `{{%auth_item}}`
        $this->dropForeignKey(
            '{{%fk-auth_item_child-parent}}',
            '{{%auth_item_child}}'
        );
        // drops foreign key for table `{{%auth_item}}`
        $this->dropForeignKey(
            '{{%fk-auth_item_child-child}}',
            '{{%auth_item_child}}'
        );
            // creates index
    $this->dropIndex(
    'child',
    '{{%auth_item_child}}'
    );
$this->dropTable('{{%auth_item_child}}');
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
