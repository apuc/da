<?php

use yii\db\Migration;

/**
 * Handles adding type to table `category_shop`.
 */
class m180613_083634_add_type_column_to_category_shop_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('category_shop', 'type', $this->integer(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('category_shop', 'type');
    }
}
