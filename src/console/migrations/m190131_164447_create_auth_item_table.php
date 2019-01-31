<?php

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
            $tableOptions = null;
            if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
                $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
            }
        $this->createTable('{{%auth_item}}', [
            'name' => $this->primaryKey(),
            'type' => $this->integer(6)->notNull(),
            'description' => $this->string()(),
            'rule_name' => $this->string(64),
            'data' => $this->resource()(),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
        ], $tableOptions);

            // creates index
    $this->createIndex(
    'idx-auth_item-type',
    '{{%auth_item}}',
    ['type'],
    false    );
        // creates index
    $this->createIndex(
    'rule_name',
    '{{%auth_item}}',
    ['rule_name'],
    false    );

        // add foreign key for table `{{%auth_rule}}`
        $this->addForeignKey(
            '{{%fk-auth_item-rule_name}}',
            '{{%auth_item}}',
            'rule_name',
            '{{%auth_rule}}',
            'name',
            'CASCADE'
        );
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->batchInsert(
        '{{%auth_item}}',
        ['name','type','description','rule_name','data','created_at','updated_at'],
        [
        		['maniakalen/workflow/delete','2','Permissions to delete workflows',NULL,NULL,'1548855715','1548855715'],
		['maniakalen/workflow/edit','2','Permissions to edit workflow configurations',NULL,NULL,'1548855715','1548855715'],
		['maniakalen/workflow/view','2','Permissions to view the configured workflows',NULL,NULL,'1548855715','1548855715'],
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
        // drops foreign key for table `{{%auth_rule}}`
        $this->dropForeignKey(
            '{{%fk-auth_item-rule_name}}',
            '{{%auth_item}}'
        );
            // creates index
    $this->dropIndex(
    'idx-auth_item-type',
    '{{%auth_item}}'
    );
        // creates index
    $this->dropIndex(
    'rule_name',
    '{{%auth_item}}'
    );
$this->dropTable('{{%auth_item}}');
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
