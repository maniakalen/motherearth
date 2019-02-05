<?php

use yii\db\Migration;

/**
 * Handles the creation of table `locations`.
 */
class m190129_092016_create_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('user_locations', [
            'id' => $this->primaryKey(),
	        'user_id' => $this->integer(),
	        'lat' => $this->string(),
	        'lon' => $this->string(),
	        'province' => $this->integer(),
	        'city' => $this->integer(),
	        'address' => $this->string()
        ], $tableOptions);

	    $this->addForeignKey(
		    'fk_user_locations_data_user_id',
		    'user_locations',
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
        $this->dropTable('user_locations');
    }
}
