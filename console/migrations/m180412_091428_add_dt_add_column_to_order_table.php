<?php

use yii\db\Migration;

/**
 * Handles adding dt_add to table `order`.
 */
class m180412_091428_add_dt_add_column_to_order_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('order', 'dt_add', $this->integer(11)->defaultValue(null));
        $this->addColumn('order', 'shop_id', $this->integer(11)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('order', 'dt_add');
        $this->dropColumn('order', 'shop_id');
    }
}
