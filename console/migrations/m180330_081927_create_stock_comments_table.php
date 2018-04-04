<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stock_comments`.
 */
class m180330_081927_create_stock_comments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('stock_comments', [
            'id' => $this->primaryKey(),
            'stock_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'content' => $this->text(),
            'dt_add' => $this->integer(11),
            'parent_id' => $this->integer(11)->defaultValue(0),
            'moder_checked' => $this->integer(1)->defaultValue(0),
            'published' => $this->integer(1)->defaultValue(0)->notNull(),
            'verified' => $this->integer(2)->defaultValue(0)
        ]);

        // creates index for column `stock_id`
        $this->createIndex(
            'idx-stock_comments-stock_id',
            'stock_comments',
            'stock_id'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-stock_comments-user_id',
            'stock_comments',
            'user_id'
        );

        // creates index for column `parent_id`
        $this->createIndex(
            'idx-stock_comments-parent_id',
            'stock_comments',
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
            'idx-stock_comments-parent_id',
            'stock_comments'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-stock_comments-user_id',
            'stock_comments'
        );

        // drops index for column `stock_id`
        $this->dropIndex(
            'idx-stock_comments-stock_id',
            'stock_comments'
        );

        $this->dropTable('stock_comments');
    }
}
