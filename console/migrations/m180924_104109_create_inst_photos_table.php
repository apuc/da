<?php

use yii\db\Migration;

/**
 * Handles the creation of table `inst_photos`.
 */
class m180924_104109_create_inst_photos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('inst_photos', [
            'id' => $this->primaryKey(),
            'inst_id' => $this->string(),
            'photo_url' => $this->string(),
            'author_name' => $this->string(),
            'author_img' => $this->string(),
            'pub_date' => $this->string(),
            'caption' => $this->string(),
            'status' => $this->integer(),
            'views' => $this->integer(),
            'slug' => $this->string(),
            'meta_title' => $this->string(),
            'meta_description' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('inst_photos');
    }
}
