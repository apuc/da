<?php

use yii\db\Migration;

/**
 * Handles adding sort_order to table `faq`.
 */
class m161118_105322_add_sort_order_column_to_faq_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('faq', 'sort_order', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('faq', 'sort_order');
    }
}
