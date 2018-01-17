<?php

use yii\db\Migration;

class m170816_142912_add_column_dt_publish_to_vk_stream extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170816_142912_add_column_dt_publish_to_vk_stream cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('vk_stream', 'dt_publish', $this->integer(11)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('vk_stream', 'dt_publish');
    }

}
