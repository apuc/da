<?php

use yii\db\Migration;

/**
 * Handles adding views to table `journal`.
 */
class m180611_135419_add_views_column_to_journal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('journal', 'views', $this->integer(11)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('journal', 'views');
    }
}
