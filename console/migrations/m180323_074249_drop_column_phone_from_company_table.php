<?php

use yii\db\Migration;

/**
 * Handles the dropping of column `phone`.
 */
class m180323_074249_drop_column_phone_from_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('company', 'phone');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('company','phone', $this->string(255)->defaultValue(null));
    }
}
