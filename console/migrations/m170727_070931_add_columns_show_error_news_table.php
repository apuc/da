<?php

use yii\db\Migration;

class m170727_070931_add_columns_show_error_news_table extends Migration
{

    public function up()
    {
        $this->addColumn('news', 'show_error', $this->integer(2)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('news','show_error');
    }


   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170727_070931_add_columns_show_error_news_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.

    */
}
