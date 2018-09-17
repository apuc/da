<?php

use yii\db\Migration;

/**
 * Handles adding slug to table `google_plus_posts`.
 */
class m180605_142750_add_slug_column_to_google_plus_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('google_plus_posts', 'slug', $this->string(500));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
