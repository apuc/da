<?php

use yii\db\Migration;

/**
 * Handles adding person_count to table `products`.
 */
class m180627_125102_add_person_count_column_to_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('products', 'person_count', $this->integer(11)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('products', 'person_count');
    }
}
