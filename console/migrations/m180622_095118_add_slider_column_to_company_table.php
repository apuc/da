<?php

use yii\db\Migration;

/**
 * Handles adding slider to table `company`.
 */
class m180622_095118_add_slider_column_to_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('company', 'slider', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('company', 'slider');
    }
}
