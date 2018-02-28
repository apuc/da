<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order_product`.
 */
class m180228_074936_create_order_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('order_product', [
            'product_id' => $this->integer(11)->notNull(),
            'order_id' => $this->integer(11)->notNull(),
            'count' => $this->integer(11)->defaultValue(1),
            'price' => $this->decimal(10, 2)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order_product');
    }
}
