<?php

use yii\db\Migration;

/**
 * Handles adding for_similar to table `product_fields`.
 */
class m180420_100406_add_for_similar_column_to_product_fields_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('product_fields', 'for_similar', $this->integer(1)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('product_fields', 'for_similar');
    }
}
