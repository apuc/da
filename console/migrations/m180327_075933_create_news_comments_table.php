<?php

use yii\db\Migration;

/**
 * Handles the creation of table `news_comments`.
 */
class m180327_075933_create_news_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('news_comments', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'content' => $this->text(),
            'dt_add' => $this->integer(11),
            'parent_id' => $this->integer(11)->defaultValue(0),
            'moder_checked' => $this->integer(1)->defaultValue(0),
            'published' => $this->integer(1)->defaultValue(0)->notNull(),
            'verified' => $this->integer(2)->defaultValue(0)
        ]);

        // creates index for column `news_id`
        $this->createIndex(
            'idx-news_comments-news_id',
            'news_comments',
            'news_id'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-news_comments-user_id',
            'news_comments',
            'user_id'
        );

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-news_comments-parent_id',
            'news_comments',
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
            'idx-news_comments-parent_id',
            'news_comments'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-news_comments-user_id',
            'news_comments'
        );

        // drops index for column `news_id`
        $this->dropIndex(
            'idx-news_comments-news_id',
            'news_comments'
        );

        $this->dropTable('news_comments');
    }
}
