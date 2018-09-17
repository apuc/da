<?php

use yii\db\Migration;

/**
 * Handles adding show_prev_in_single to table `news`.
 */
class m180731_102949_add_show_prev_in_single_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'show_prev_in_single', $this->integer(1)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'show_prev_in_single');
    }
}
