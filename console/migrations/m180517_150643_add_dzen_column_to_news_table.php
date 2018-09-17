<?php

use yii\db\Migration;

/**
 * Handles adding dzen to table `news`.
 */
class m180517_150643_add_dzen_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'dzen', $this->integer(1)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'dzen');
    }
}
