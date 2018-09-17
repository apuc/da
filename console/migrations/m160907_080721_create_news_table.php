<?php

use yii\db\Migration;

/**
 * Handles the creation for table `news`.
 */
class m160907_080721_create_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'content' => $this->text(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'slug' => $this->string(255),
            'tags' => $this->string(255),
            'photo' => $this->string(255),
            'status' => $this->integer(1),
            'user_id' => $this->integer(11),
            'lang_id' => $this->integer(11)->defaultValue(1),
            'views' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('news');
    }
}
