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
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            'password_reset_token' => $this->string(255),
            'email' => $this->string(255)->notNull(),
            'status' => $this->integer(6)->notNull()->defaultValue(10),
            'created_at' => $this->integer(11)->notNull(),
            'updated_at' => $this->integer(11)->notNull(),
        ], $tableOptions);

            // creates index
    $this->createIndex(
    'email',
    '{{%user}}',
    ['email'],
    true    );
        // creates index
    $this->createIndex(
    'username',
    '{{%user}}',
    ['username'],
    true    );
        // creates index
    $this->createIndex(
    'password_reset_token',
    '{{%user}}',
    ['password_reset_token'],
    true    );
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->batchInsert(
        '{{%user}}',
        ['id','username','auth_key','password_hash','password_reset_token','email','status','created_at','updated_at'],
        [
        		['2','super_admin','mxsQM0zhniEDMguART4WZsOm0ZE9fDcr','$2y$13$d643cTpiqfQPuFkxiaN1eOHreIlhFYEiJ8qlk.FlQneP4WZ.3a.FS',NULL,'maniakalen@gmail.com','1','1548857021','1548857021'],
		['6','john.smith','4BDwum8vtXbQvgM7frddiZ3KEyKYLlJB','$2y$13$fp8s1jwDseiaZLI6PnocQubf90rCXyFwC0bbD7j54/3bsEjYxb56K',NULL,'john.smith@gmail.com','1','1548945063','1548945063'],
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
    'email',
    '{{%user}}'
    );
        // creates index
    $this->dropIndex(
    'username',
    '{{%user}}'
    );
        // creates index
    $this->dropIndex(
    'password_reset_token',
    '{{%user}}'
    );
$this->dropTable('{{%user}}');
        } catch (\Exception $ex) {
            return false;
        }

        return true;
    }
}
