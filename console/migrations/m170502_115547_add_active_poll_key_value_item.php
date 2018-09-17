<?php

use yii\db\Migration;

class m170502_115547_add_active_poll_key_value_item extends Migration
{
    public function up()
    {
        $this->insert('key_value',['key'=>'active_poll']);
    }

    public function down()
    {

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
