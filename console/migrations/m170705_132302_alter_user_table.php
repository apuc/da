<?php

use yii\db\Migration;

class m170705_132302_alter_user_table extends Migration
{

    public function up()
    {
        $this->alterColumn('{{%user}}','last_login_at', $this->integer(11)->defaultValue(0));
    }

    public function down()
    {
        $this->alterColumn('{{%user}}','last_login_at', $this->integer(11)->notNull());
    }
   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170705_132302_alter_user_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170705_132302_alter_user_table cannot be reverted.\n";

        return false;
    }
    */
}
