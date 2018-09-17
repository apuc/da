<?php

use yii\db\Migration;

/**
 * Handles adding rating to table `company_feedback`.
 */
class m180323_115937_add_rating_column_to_company_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('company_feedback', 'rating', $this->integer(11));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('company_feedback', 'rating');
    }
}
