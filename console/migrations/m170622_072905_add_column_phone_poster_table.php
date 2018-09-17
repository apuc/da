<?php

use yii\db\Migration;

class m170622_072905_add_column_phone_poster_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('poster', 'phone', $this->string(255));
    }

    public function safeDown()
    {
        $this->dropColumn('poster', 'phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170622_072905_add_column_phone_poster_table cannot be reverted.\n";

        return false;
    }
    */
}
