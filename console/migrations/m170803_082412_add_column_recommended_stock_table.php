<?php

use yii\db\Migration;

class m170803_082412_add_column_recommended_stock_table extends Migration
{
    public function up()
    {
        $this->addColumn('stock', 'recommended', $this->integer(2)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('stock', 'recommended');
    }

    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170803_082412_add_column_recommended_stock_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170803_082412_add_column_recommended_stock_table cannot be reverted.\n";

        return false;
    }
    */
}
