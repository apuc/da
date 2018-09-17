<?php

use yii\db\Migration;

/**
 * Handles adding status to table `google_plus_posts`.
 */
class m180605_070918_add_status_column_to_google_plus_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('google_plus_posts', 'status', $this->integer(2)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('google_plus_posts', 'status');
    }
}
