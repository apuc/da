<?php

use yii\db\Migration;

/**
 * Handles adding order to table `category_posts_consulting`.
 */
class m161117_073816_add_order_column_to_category_posts_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category_posts_consulting', 'order', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category_posts_consulting', 'order');
    }
}
