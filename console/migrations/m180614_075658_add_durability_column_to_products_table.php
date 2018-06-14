<?php

use yii\db\Migration;

/**
 * Handles adding durability to table `products`.
 */
class m180614_075658_add_durability_column_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'durability', $this->integer(10)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'durability');
    }
}
