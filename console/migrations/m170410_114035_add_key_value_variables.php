<?php

use yii\db\Migration;

class m170410_114035_add_key_value_variables extends Migration
{
    public function up()
    {
        $this->insert('key_value', ['key' => 'intrested_in_posters']);
    }

    public function down()
    {
        $this->delete('key_value', ['key' => 'intrested_in_posters']);
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
