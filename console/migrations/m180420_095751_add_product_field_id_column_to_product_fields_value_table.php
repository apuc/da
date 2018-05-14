<?php

use yii\db\Migration;

/**
 * Handles adding product_field_id to table `product_fields_value`.
 */
class m180420_095751_add_product_field_id_column_to_product_fields_value_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_fields_value', 'product_field_id', $this->integer(11)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product_fields_value', 'product_field_id');
    }
}
