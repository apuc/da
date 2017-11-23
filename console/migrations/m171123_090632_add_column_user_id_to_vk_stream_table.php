<?php

use yii\db\Migration;

/**
 * Class m171123_090632_add_column_user_id_to_vk_stream_table
 */
class m171123_090632_add_column_user_id_to_vk_stream_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('vk_stream', 'user_id', $this->integer(11)->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('vk_stream', 'user_id');
    }

}
