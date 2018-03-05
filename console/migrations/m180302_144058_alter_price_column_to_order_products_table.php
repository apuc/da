<?php

use yii\db\Migration;

/**
 * Class m180302_144058_alter_price_column_to_order_products_table
 */
class m180302_144058_alter_price_column_to_order_products_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->dropColumn('order_product', 'price');
        $this->addColumn('order_product', 'shop_id', $this->integer(11)->notNull());
    }

    public function down()
    {
        $this->dropColumn('order_product', 'shop_id');
        $this->addColumn('order_product', 'price', $this->integer(11));
    }

}
