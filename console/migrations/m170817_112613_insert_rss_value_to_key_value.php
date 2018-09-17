<?php

use yii\db\Migration;

class m170817_112613_insert_rss_value_to_key_value extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170817_112613_insert_rss_value_to_key_value cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('key_value', [
            'key' => 'rss_stream_title',
            'value' => 'ДА. В соцсетях',
        ]);

        $this->insert('key_value', [
            'key' => 'rss_stream_desc',
            'value' => 'Портал города Донецка',
        ]);
    }

    public function down()
    {
        $this->delete('key_value', [
            'key' => 'rss_stream_title'
        ]);

        $this->delete('key_value', [
            'key' => 'rss_stream_desc',
        ]);
    }

}
