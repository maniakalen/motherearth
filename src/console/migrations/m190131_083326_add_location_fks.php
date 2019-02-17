<?php

use yii\db\Migration;

/**
 * Class m190131_083326_add_location_fks
 */
class m190131_083326_add_location_fks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk_user_locations_data_geo_unit_id',
            'user_locations',
            'address',
            'geo_units',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0');
        $this->dropForeignKey('fk_user_data_geounit_province_id', 'user_locations');
        $this->dropForeignKey('fk_user_data_geounit_city_id', 'user_locations');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190131_083326_add_location_fks cannot be reverted.\n";

        return false;
    }
    */
}
