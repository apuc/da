<?php

use yii\db\Migration;

class m170622_080244_add_column_metka_poster_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('poster', 'metka', $this->string(25));
    }

    public function safeDown()
    {
        $this->dropColumn('poster', 'metka');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170622_080244_add_column_metka_poster_table cannot be reverted.\n";

        return false;
    }
    */
}
