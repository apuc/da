<?php

use yii\db\Migration;

/**
 * Handles the creation for table `posts_digest`.
 */
class m161025_083232_create_posts_digest_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts_digest', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'slug' => $this->string(255),
            'photo' => $this->string(255),
            'user_id' => $this->integer(11),
            'type' => $this->string(255)->notNull(),
            'cat_id' => $this->integer(11)->notNull(),
            'views' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('posts_digest');
    }
}
