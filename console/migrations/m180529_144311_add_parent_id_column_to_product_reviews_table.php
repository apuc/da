<?php

use yii\db\Migration;

/**
 * Handles adding parent_id to table `product_reviews`.
 */
class m180529_144311_add_parent_id_column_to_product_reviews_table extends Migration
{
    public function up()
    {
        $this->addColumn('products_reviews', 'parent_id', $this->integer(11)->defaultValue(null));
    }
    public function down()
    {
        $this->dropColumn('products_reviews', 'parent_id');
    }
}
