<?php

use yii\db\Migration;

class m170424_191014_insert_hot_stock_to_options_table extends Migration
{
    public function up()
    {
        $this->insert('key_value', [
            'key' => 'hot_stock',
            'value' => '',
            'dt_add' => time(),
            'dt_update' => time(),
        ]);
    }

    public function down()
    {
        $this->delete('key_value', ['key' => 'hot_stock']);
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
