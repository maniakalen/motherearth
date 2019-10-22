<?php

namespace app\migrations;

use yii\db\Migration;
use yii\rbac\Item;

/**
 * Class M191015153146RolesAndPermissions
 */
class M191015153146RolesAndPermissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        try {

            $this->execute('SET FOREIGN_KEY_CHECKS = 0');
            $time = time();
            $this->batchInsert(
                '{{%auth_item}}',
                ['name','type','description','rule_name','data','created_at','updated_at'],
                [
                    ['admin/users/full', Item::TYPE_PERMISSION, 'Full users administrator', NULL, NULL, $time, $time],
                    ['admin/users/self', Item::TYPE_PERMISSION, 'User profile control', NULL, NULL, $time, $time],
                ]);
            $this->insert('auth_item_child', ['parent' => 'super_admin', 'child' => 'admin/users/full']);
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
            $this->delete('{{%auth_item}}', ['like', 'name', ['admin/users/%']]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "M191015153146RolesAndPermissions cannot be reverted.\n";

        return false;
    }
    */
}
