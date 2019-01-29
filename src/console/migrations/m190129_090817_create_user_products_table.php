<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_products`.
 */
class m190129_090817_create_user_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_products', [
            'id' => $this->primaryKey(),
	        'user_id' => $this->integer(),
	        'product_id' => $this->integer()
        ]);

        $this->addForeignKey(
        	'fk_user_product_user_id',
	        'user_products',
	        'user_id',
	        'user',
	        'id'
	        );
	    $this->addForeignKey(
		    'fk_user_product_product_id',
		    'user_products',
		    'product_id',
		    'products',
		    'id'
	    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_products');
    }
}
