<?php

use yii\db\Migration;

class m170817_110549_add_column_rss_to_vk_stream extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170817_110549_add_column_rss_to_vk_stream cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('vk_stream', 'rss', $this->integer(1)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('vk_stream', 'rss');
    }

}
