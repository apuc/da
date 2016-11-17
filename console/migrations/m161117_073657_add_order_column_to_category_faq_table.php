<?php

use yii\db\Migration;

/**
 * Handles adding order to table `category_faq`.
 */
class m161117_073657_add_order_column_to_category_faq_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category_faq', 'order', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category_faq', 'order');
    }
}
