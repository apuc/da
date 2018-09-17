<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `ads_fields`.
 */
class m180119_091534_create_ads_fields_table extends Migration
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

        $this->createTable('product_fields', [
            'id'                => Schema::TYPE_PK,
            'type_id'           => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'label'             => Schema::TYPE_STRING . '(255) NOT NULL',
            'template'          => Schema::TYPE_STRING . '(255) DEFAULT NULL',
            'name' => $this->string(255),
            'interval' => $this->integer(1)->defaultValue(0)

        ], $tableOptions);


        $this->addForeignKey(
            'product_fields_product_fields_type_fk',
            'product_fields',
            'type_id',
            'product_fields_type',
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
        $this->dropForeignKey('product_fields_product_fields_type_fk', 'product_fields');

        $this->dropTable('product_fields');
    }
}
