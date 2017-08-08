<?php

use yii\db\Migration;

class m170807_094301_create_table_Vk_gif extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170807_094301_create_table_Vk_gif cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('vk_gif', [
            'id' => $this->primaryKey(),
            'vk_id' => $this->integer(11)->notNull(),
            'vk_user_id' => $this->integer(11),
            'preview_m' => $this->string(255),
            'preview_s' => $this->string(255),
            'preview_x' => $this->string(255),
            'preview_o' => $this->string(255),
            'gif_link' => $this->string(255),
            'post_id' => $this->integer(11),
            'owner_id' => $this->integer(11),
            'access_key' => $this->string(255),
            'vk_post_id' => $this->integer(11),
            'comment_id' => $this->integer(11)
        ]);
    }

    public function down()
    {
        $this->dropTable('vk_gif');
    }

}
