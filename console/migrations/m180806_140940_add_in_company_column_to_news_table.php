<?php

use yii\db\Migration;

/**
 * Handles adding in_company to table `news`.
 */
class m180806_140940_add_in_company_column_to_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'in_company', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'in_company');
    }
}
