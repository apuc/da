<?php

use yii\db\Migration;

class m170809_084855_add_columns_to_VkGroup extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170809_084855_add_columns_to_VkGroup cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('vk_groups', 'photo_50', $this->string(255)->defaultValue(''));
        $this->addColumn('vk_groups', 'photo_100', $this->string(255)->defaultValue(''));
        $this->addColumn('vk_groups', 'photo_200', $this->string(255)->defaultValue(''));
    }

    public function down()
    {
       $this->dropColumn('vk_groups', 'photo_50');
       $this->dropColumn('vk_groups', 'photo_100');
       $this->dropColumn('vk_groups', 'photo_200');
    }

}
