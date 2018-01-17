<?php

use yii\db\Migration;

class m170825_115742_add_column_sticker_to_vk_comments extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170825_115742_add_column_sticker_to_vk_comments cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('vk_comments', 'sticker', $this->string(255)->defaultValue(''));
    }

    public function down()
    {
        $this->dropColumn('vk_comments', 'sticker');
    }

}
