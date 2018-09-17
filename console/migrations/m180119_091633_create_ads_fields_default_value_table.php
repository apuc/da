<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `ads_fields_default_value`.
 */
class m180119_091633_create_ads_fields_default_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('product_fields_default_value', [
            'id'                => Schema::TYPE_PK,
            'value'             => Schema::TYPE_STRING . '(255) NOT NULL',
            'product_field_id' => Schema::TYPE_INTEGER . '(11) NOT NULL'
        ], $tableOptions);

        $this->addForeignKey(
            'product_fields_default_value_product_fields_fk',
            'product_fields_default_value',
            'product_field_id',
            'product_fields',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('product_fields_default_value_product_fields_fk', 'product_fields_default_value');

        $this->dropTable('product_fields_default_value');
    }
}
