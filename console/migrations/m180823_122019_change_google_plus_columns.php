<?php

use yii\db\Migration;

/**
 * Class m180823_122019_change_google_plus_columns
 */
class m180823_122019_change_google_plus_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('google_plus_photo', 'url', $this->text());
        $this->alterColumn('google_plus_photo', 'full_image_url', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('google_plus_photo','url', $this->string(255));
        $this->alterColumn('google_plus_photo','full_image_url', $this->string(255) );

    }
}
