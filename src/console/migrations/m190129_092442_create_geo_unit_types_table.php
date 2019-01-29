<?php

use yii\db\Migration;

/**
 * Handles the creation of table `geo_unit_types`.
 */
class m190129_092442_create_geo_unit_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('geo_unit_types', [
            'id' => $this->primaryKey(),
	        'name' => $this->string()
        ]);

        $this->batchInsert(
	        'geo_unit_types',
	        ['name'],
	        [
	        	['state'],
	        	['province'],
	        	['city'],
	        	['vilage'],
	        ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('geo_unit_types');
    }
}
