<?php

use yii\db\Migration;

/**
 * Handles adding sort_order to table `posts_digest`.
 */
class m161118_105254_add_sort_order_column_to_posts_digest_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('posts_digest', 'sort_order', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('posts_digest', 'sort_order');
    }
}
