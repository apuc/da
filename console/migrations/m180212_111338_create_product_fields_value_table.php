<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `product_fields_value`.
 */
class m180212_111338_create_product_fields_value_table extends Migration
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

        $this->createTable('product_fields_value', [
            'id'                    => Schema::TYPE_PK,
            'product_id'                => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'product_fields_name'                => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'value'                 => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'value_id'              => Schema::TYPE_INTEGER . '(11) DEFAULT NULL',
        ], $tableOptions);

        $this->addForeignKey(
            'product_fields_value_product_fk',
            'product_fields_value',
            'product_id',
            'products',
            'id',
            'RESTRICT',
            'CASCADE'
        );
        /*$this->addForeignKey(
            'product_fields_value_product_fields_fk',
            'product_fields_value',
            'product_fields_id',
            'product_fields',
            'id',
            'RESTRICT',
            'CASCADE'
        );*/
        $this->addForeignKey(
            'product_fields_value_product_fields_default_value_fk',
            'product_fields_value',
            'value_id',
            'product_fields_default_value',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropForeignKey('product_fields_value_product_fields_default_value_fk', 'product_fields_value');
        $this->dropForeignKey('product_fields_value_product_fields_fk', 'product_fields_value');
        $this->dropForeignKey('product_fields_value_product_fk', 'product_fields_value');


        $this->dropTable('product_fields_value');
    }
}
