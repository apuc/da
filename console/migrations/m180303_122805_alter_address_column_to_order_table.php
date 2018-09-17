<?php

use yii\db\Migration;

/**
 * Class m180303_122805_alter_address_column_to_order_table
 */
class m180303_122805_alter_address_column_to_order_table extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('order', 'address', $this->string(255)->notNull());
    }

    public function down()
    {
        $this->alterColumn('order', 'address', $this->integer(11)->notNull());
    }

}
