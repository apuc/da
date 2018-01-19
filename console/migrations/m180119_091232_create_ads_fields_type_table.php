<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `ads_fields_type`.
 */
class m180119_091232_create_ads_fields_type_table extends Migration
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

        $this->createTable('product_fields_type', [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_STRING . '(100) NOT NULL',
        ], $tableOptions);

        $this->insert('product_fields_type', [
            'type' => 'checkbox',
        ]);

        $this->insert('product_fields_type', [
            'type' => 'radio',
        ]);

        $this->insert('product_fields_type', [
            'type' => 'text',
        ]);

        $this->insert('product_fields_type', [
            'type' => 'select',
        ]);

        $this->insert('product_fields_type', [
            'type' => 'textarea',
        ]);
    }

    public function down()
    {
        $this->dropTable('product_fields_type');
    }
}
