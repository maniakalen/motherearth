<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_additional_data`.
 */
class m190129_091044_create_user_additional_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_additional_data', [
            'id' => $this->primaryKey(),
	        'user_id' => $this->integer(),
	        'phone' => $this->string(),
	        'details' => $this->text()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_additional_data');
    }
}
