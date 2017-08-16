<?php

use yii\db\Migration;

class m170816_085628_add_column_slug_to_stock extends Migration
{
   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170816_085628_add_column_slug_to_stock cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('stock', 'slug', $this->string('255')->defaultValue(''));
    }

    public function down()
    {
        $this->dropColumn('stock', 'slug');
    }
}
