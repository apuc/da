<?php

use yii\db\Migration;

/**
 * Handles adding three to table `vk_stream`.
 */
class m170727_125639_add_three_column_to_vk_stream_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('vk_stream', 'status', $this->integer(1)->defaultValue(0));
        $this->addColumn('vk_stream', 'views', $this->integer(11)->defaultValue(0));
        $this->addColumn('vk_stream', 'likes', $this->integer(11)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('vk_stream', 'status');
        $this->dropColumn('vk_stream', 'views');
        $this->dropColumn('vk_stream', 'likes');
    }
}
