<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vk_stream`.
 */
class m170513_115941_create_vk_stream_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vk_stream', [
            'id' => $this->primaryKey(),
            'vk_id' => $this->string(255)->notNull(),
            'from_id' => $this->integer(11),
            'owner_id' => $this->integer(11),
            'owner_type' => $this->integer(1)->defaultValue(0),
            'dt_add' => $this->integer(11),
            'post_type' => $this->string(255),
            'text' => $this->text(),
            'from_type' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vk_stream');
    }
}
