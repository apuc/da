<?php

use yii\db\Migration;

/**
 * Class m180327_150717_add_columns_products_table
 */
class m180327_150717_add_columns_products_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('products', 'payment', $this->text());
        $this->addColumn('products', 'delivery', $this->text());
    }

    public function down()
    {
        $this->dropColumn('products', 'payment');
        $this->dropColumn('products', 'delivery');
    }

}
