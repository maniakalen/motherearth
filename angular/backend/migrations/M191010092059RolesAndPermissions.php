<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Class M191010092059RolesAndPermissions
 */
class M191010092059RolesAndPermissions extends Migration
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
                    ['admin', '1', 'System administrator', NULL, NULL, $time, $time],
                    ['customer', '1', 'Customer rules', NULL, NULL, $time, $time],
                    ['provider', '1', 'Provider rules', NULL, NULL, $time, $time],
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
            $this->delete('{{%auth_item}}', ['in', 'name', ['admin', 'customer', 'provider']]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
