<?php

use yii\db\Migration;

/**
 * Handles adding order to table `category_posts_digest`.
 */
class m161117_073835_add_order_column_to_category_posts_digest_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category_posts_digest', 'sort_order', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category_posts_digest', 'order');
    }
}
