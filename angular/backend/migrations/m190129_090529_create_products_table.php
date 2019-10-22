<?php
namespace app\migrations;
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
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('products', [
            'id' => $this->primaryKey(),
	        'name' => $this->string(),
	        'status' => $this->boolean()->defaultValue(true)
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('products');
    }
}
