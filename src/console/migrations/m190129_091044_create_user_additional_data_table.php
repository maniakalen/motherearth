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
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('user_additional_data', [
            'id' => $this->primaryKey(),
	        'user_id' => $this->integer(),
	        'user_type' => 'ENUM("producer", "consumer")',
	        'phone' => $this->string(),
	        'name' => $this->string(),
	        'surname' => $this->string(),
	        'details' => $this->text()
        ], $tableOptions);

	    $this->addForeignKey(
		    'fk_user_additional_data_user_id',
		    'user_additional_data',
		    'user_id',
		    'user',
		    'id'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_additional_data');
    }
}
