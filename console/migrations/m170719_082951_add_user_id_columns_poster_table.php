<?php

use yii\db\Migration;

class m170719_082951_add_user_id_columns_poster_table extends Migration
{

    public function up()
    {
        $this->addColumn('poster', 'user_id', $this->integer(11));
    }

    public function down()
    {
        $this->dropColumn('poster', 'user_id');
    }


   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170719_082951_add_user_id_columns_poster_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.

    */
}
