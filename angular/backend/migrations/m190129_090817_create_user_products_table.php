<?php
namespace app\migrations;
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
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('user_products', [
            'id' => $this->primaryKey(),
	        'user_id' => $this->integer(),
	        'product_id' => $this->integer()
        ], $tableOptions);

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
