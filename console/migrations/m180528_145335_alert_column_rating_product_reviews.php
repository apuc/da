<?php

use yii\db\Migration;

/**
 * Class m180528_145335_alert_column_rating_product_reviews
 */
class m180528_145335_alert_column_rating_product_reviews extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('products_reviews', 'rating', $this->integer(11));
    }

    public function down()
    {
        return true;
    }

}
