<?php

use yii\db\Migration;

class m170804_082242_add_column_to_vk_stream_table extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170804_082242_add_column_to_vk_stream_table cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('vk_stream', 'title', $this->string(255)->defaultValue(''));
        $this->addColumn('vk_stream', 'slug', $this->string(255)->defaultValue(''));
        $this->addColumn('vk_stream', 'meta_descr', $this->string(255)->defaultValue(''));
        $this->addColumn('vk_stream', 'comment_status', $this->boolean()->defaultValue(1));
    }

    public function down()
    {
        $this->dropColumn('vk_stream', 'title');
        $this->dropColumn('vk_stream', 'slug');
        $this->dropColumn('vk_stream', 'meta_descr');
        $this->dropColumn('vk_stream', 'comment_status');
    }

}
