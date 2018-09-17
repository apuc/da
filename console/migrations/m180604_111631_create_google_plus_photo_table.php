<?php

use yii\db\Migration;

/**
 * Handles the creation of table `google_plus_photo`.
 */
class m180604_111631_create_google_plus_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('google_plus_photo', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(11)->notNull(),
            'display_name' => $this->string(255)->defaultValue(null),
            'google_url' => $this->string(255)->defaultValue(null),
            'url' => $this->string(255)->defaultValue(null),
            'full_image_url' => $this->string(255)->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('google_plus_photo');
    }
}
