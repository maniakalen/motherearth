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
        $this->createTable('user_locations', [
            'id' => $this->primaryKey(),
	        'user_id' => $this->integer(),
	        'lat' => $this->string(),
	        'lon' => $this->string(),
	        'province' => $this->integer(),
	        'city' => $this->integer(),
	        'address' => $this->string()
        ]);

	    $this->addForeignKey(
		    'fk_user_data_user_id',
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
