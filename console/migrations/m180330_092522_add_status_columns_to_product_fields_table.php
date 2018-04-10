<?php

use yii\db\Migration;

/**
 * Handles adding status to table `product_fields`.
 */
class m180330_092522_add_status_columns_to_product_fields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_fields', 'status', $this->integer(1)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product_fields', 'status');
    }
}
