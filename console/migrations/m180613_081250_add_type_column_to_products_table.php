<?php

use yii\db\Migration;

/**
 * Handles adding type to table `products`.
 */
class m180613_081250_add_type_column_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'type', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'type');
    }
}
