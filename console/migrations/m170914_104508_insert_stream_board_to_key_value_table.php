<?php

use yii\db\Migration;

class m170914_104508_insert_stream_board_to_key_value_table extends Migration
{
    public function up()
    {
        $this->insert('key_value', [
            'key' => 'stream_title_page',
            'value' => 'ДА. В соцсетях',
        ]);

        $this->insert('key_value', [
            'key' => 'stream_desc_page',
            'value' => 'Портал города Донецка',
        ]);

        $this->insert('key_value', [
            'key' => 'board_title_page',
            'value' => 'Объявления',
        ]);

        $this->insert('key_value', [
            'key' => 'board_desc_page',
            'value' => 'Объявления',
        ]);
    }

    public function down()
    {
        $this->delete('key_value', [
            'key' => 'stream_title_page'
        ]);

        $this->delete('key_value', [
            'key' => 'stream_desc_page',
        ]);

        $this->delete('key_value', [
            'key' => 'board_title_page',
        ]);

        $this->delete('key_value', [
            'key' => 'board_desc_page',
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170914_104508_insert_stream_board_to_key_value_table cannot be reverted.\n";

        return false;
    }
    */
}
