<?php

use yii\db\Migration;

/**
 * Handles the creation of table `google_plus_posts`.
 */
class m180604_085509_create_google_plus_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('google_plus_posts', [
            'id' => $this->primaryKey(),
            'updated' => $this->string(100)->defaultValue(null),
            'published' => $this->string(100)->defaultValue(null),
            'title' => $this->string(255)->defaultValue(null),
            'post_id' => $this->string(100)->defaultValue(null),
            'url' => $this->string(100)->defaultValue(null),
            'user_id' => $this->integer(11)->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('google_plus_posts');
    }
}
