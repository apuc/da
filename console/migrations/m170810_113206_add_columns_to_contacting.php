<?php

use yii\db\Migration;

class m170810_113206_add_columns_to_contacting extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170810_113206_add_columns_to_contacting cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('contacting', 'username', $this->string(100)->defaultValue(''));
        $this->addColumn('contacting', 'email', $this->string(100)->defaultValue(''));
        $this->addColumn('contacting', 'status', $this->integer(1)->defaultValue(0));
        $this->addColumn('contacting', 'answer', $this->string(255)->defaultValue(''));
    }

    public function down()
    {
        $this->dropColumn('contacting', 'username');
        $this->dropColumn('contacting', 'email');
        $this->dropColumn('contacting', 'status');
        $this->dropColumn('contacting', 'answer');
    }

}
