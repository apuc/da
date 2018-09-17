<?php

use yii\db\Migration;

/**
 * Class m180528_122403_add_columns_to_products_reviews
 */
class m180528_122403_add_columns_to_products_reviews extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('products_reviews', 'plus', $this->string(512));
        $this->addColumn('products_reviews', 'minus', $this->string(512));
    }

    public function down()
    {
        $this->dropColumn('products_reviews', 'plus');
        $this->dropColumn('products_reviews', 'minus');
    }

}
