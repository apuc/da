<?php

use yii\db\Migration;

class m170705_103826_add_column_price_company_tariff_order_table extends Migration
{
    public function up()
    {
        $this->addColumn('company_tariff_order', 'price', $this->string(255));
    }

    public function down()
    {
        $this->dropColumn('company_tariff_order', 'price');
    }


    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170705_103826_add_column_price_company_tariff_order_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170705_103826_add_column_price_company_tariff_order_table cannot be reverted.\n";

        return false;
    }
    */
}
