<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tw_posts`.
 */
class m180223_155728_create_tw_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tw_posts', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'meta_descr' => $this->text(),
            'tw_id' => $this->string(100)->notNull(),
            'content' => $this->text(),
            'media_url' => $this->string(255),
            'link' => $this->string(255),
            'page_id' => $this->integer(11)->notNull(),
            'page_title' => $this->string(255),
            'page_icon' => $this->string(255),
            'dt_add' => $this->integer(11),
            'dt_publish' => $this->integer(11)->defaultValue(null),
            'status' => $this->integer(1)->defaultValue(0),
            'comment_status' => $this->integer(1)->defaultValue(0),
            'slug' => $this->string(255),
            'views' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tw_posts');
    }
}
