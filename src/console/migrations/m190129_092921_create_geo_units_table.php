<?php

use yii\db\Migration;

/**
 * Handles the creation of table `geo_units`.
 */
class m190129_092921_create_geo_units_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('geo_units', [
            'id' => $this->primaryKey(),
	        'type' => $this->integer(),
	        'name' => $this->string(),
	        'lat' => $this->string(),
	        'lon' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('geo_units');
    }
}
