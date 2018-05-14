<?php

use yii\db\Migration;

/**
 * Handles adding stock_descr to table `products`.
 */
class m180419_134051_add_stock_descr_column_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'stock_descr', $this->text()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'stock_descr');
    }
}
