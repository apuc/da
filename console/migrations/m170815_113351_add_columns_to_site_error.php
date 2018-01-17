<?php

use yii\db\Migration;

class m170815_113351_add_columns_to_site_error extends Migration
{
   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170815_113351_add_columns_to_site_error cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('site_error', 'username', $this->string(100)->defaultValue(''));

        $this->addColumn('site_error', 'email', $this->string(100)->defaultValue(''));
    }

    public function down()
    {
        $this->dropColumn('site_error','username');
        $this->dropColumn('site_error','email');
    }

}
