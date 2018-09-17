<?php

use yii\db\Migration;

/**
 * Handles adding start_page to table `company`.
 */
class m180607_103848_add_start_page_column_to_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('company', 'start_page', $this->integer(2)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('company', 'start_page');
    }
}
