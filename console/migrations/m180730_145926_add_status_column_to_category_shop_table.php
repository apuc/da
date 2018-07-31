<?php

use yii\db\Migration;

/**
 * Handles adding status to table `category_shop`.
 */
class m180730_145926_add_status_column_to_category_shop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category_shop', 'status', $this->integer(1)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category_shop', 'status');
    }
}
