<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m190129_090529_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
	        'name' => $this->string(),
	        'status' => $this->boolean()->defaultValue(true)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products');
    }
}
