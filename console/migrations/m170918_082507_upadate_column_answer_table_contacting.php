<?php

use yii\db\Migration;

class m170918_082507_upadate_column_answer_table_contacting extends Migration
{

    public function up()
    {
        $this->alterColumn('contacting', 'answer', $this->text());
    }

    public function down()
    {
        $this->alterColumn('contacting', 'answer', $this->string(255));
    }

    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170918_082507_upadate_column_answer_table_contacting cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.

    */
}
