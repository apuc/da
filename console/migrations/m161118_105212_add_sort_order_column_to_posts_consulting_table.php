<?php

use yii\db\Migration;

/**
 * Handles adding sort_order to table `posts_consulting`.
 */
class m161118_105212_add_sort_order_column_to_posts_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('posts_consulting', 'sort_order', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('posts_consulting', 'sort_order');
    }
}
