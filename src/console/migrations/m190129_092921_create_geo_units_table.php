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
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('geo_units', [
            'id' => $this->primaryKey(),
	        'type' => "ENUM('county', 'city', 'district')",
	        'name' => $this->string(),
	        'lat' => $this->string(),
	        'lon' => $this->string()
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('geo_units');
    }
}
