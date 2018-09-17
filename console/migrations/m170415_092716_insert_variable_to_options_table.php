<?php

use yii\db\Migration;

class m170415_092716_insert_variable_to_options_table extends Migration
{
    public function up()
    {
        $this->insert('key_value', [
            'key' => 'poster_page_top_slider',
            'value' => '',
            'dt_add' => time(),
            'dt_update' => time(),
        ]);
    }

    public function down()
    {
        $this->delete('key_value', ['key' => 'poster_page_top_slider']);
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
