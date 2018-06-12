<?php

use yii\db\Migration;

/**
 * Handles adding slug to table `journal`.
 */
class m180611_131302_add_slug_column_to_journal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('journal', 'slug', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('journal', 'slug');
    }
}
