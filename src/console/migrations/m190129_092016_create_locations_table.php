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
        $this->createTable('locations', [
            'id' => $this->primaryKey(),
	        'lat' => $this->string(),
	        'lon' => $this->string(),
	        'province' => $this->integer(),
	        'city' => $this->integer(),
	        'address' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('locations');
    }
}
