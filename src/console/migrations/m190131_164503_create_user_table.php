<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m190131_164503_create_user_table extends Migration
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

            $this->execute('SET FOREIGN_KEY_CHECKS = 0');
            $this->batchInsert(
            '{{%user}}',
            ['id','username','auth_key','password_hash','password_reset_token','email','status','created_at','updated_at'],
            [
                ['2','super_admin','mxsQM0zhniEDMguART4WZsOm0ZE9fDcr','$2y$13$d643cTpiqfQPuFkxiaN1eOHreIlhFYEiJ8qlk.FlQneP4WZ.3a.FS',NULL,'maniakalen@gmail.com','1','1548857021','1548857021'],
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
            $this->delete('{{%user}}', ['id' => 2]);
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
