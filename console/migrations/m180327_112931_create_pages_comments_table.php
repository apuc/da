<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages_comments`.
 */
class m180327_112931_create_pages_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pages_comments', [
            'id' => $this->primaryKey(),
            'pages_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'content' => $this->text(),
            'dt_add' => $this->integer(11),
            'parent_id' => $this->integer(11)->defaultValue(0),
            'moder_checked' => $this->integer(1)->defaultValue(0),
            'published' => $this->integer(1)->defaultValue(0)->notNull(),
            'verified' => $this->integer(2)->defaultValue(0)
        ]);

        // creates index for column `pages_id`
        $this->createIndex(
            'idx-pages_comments-pages_id',
            'pages_comments',
            'pages_id'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-pages_comments-user_id',
            'pages_comments',
            'user_id'
        );

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-pages_comments-parent_id',
            'pages_comments',
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
            'idx-pages_comments-parent_id',
            'pages_comments'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-pages_comments-user_id',
            'pages_comments'
        );

        // drops index for column `pages_id`
        $this->dropIndex(
            'idx-pages_comments-pages_id',
            'pages_comments'
        );

        $this->dropTable('pages_comments');
    }
}
