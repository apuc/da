<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vk_stream_comments`.
 */
class m180327_120509_create_vk_stream_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('vk_stream_comments', [
            'id' => $this->primaryKey(),
            'vk_stream_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'content' => $this->text(),
            'dt_add' => $this->integer(11),
            'parent_id' => $this->integer(11)->defaultValue(0),
            'moder_checked' => $this->integer(1)->defaultValue(0),
            'published' => $this->integer(1)->defaultValue(0)->notNull(),
            'verified' => $this->integer(2)->defaultValue(0)
        ]);

        // creates index for column `vk_stream_id`
        $this->createIndex(
            'idx-vk_stream_comments-vk_stream_id',
            'vk_stream_comments',
            'vk_stream_id'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-vk_stream_comments-user_id',
            'vk_stream_comments',
            'user_id'
        );

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-vk_stream_comments-parent_id',
            'vk_stream_comments',
            'parent_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops index for column `parent_id`
        $this->dropIndex(
            'idx-vk_stream_comments-parent_id',
            'vk_stream_comments'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-vk_stream_comments-user_id',
            'vk_stream_comments'
        );

        // drops index for column `vk_stream_id`
        $this->dropIndex(
            'idx-vk_stream_comments-vk_stream_id',
            'vk_stream_comments'
        );

        $this->dropTable('vk_stream_comments');
    }
}
