<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products_reviews`.
 */
class m180305_080450_create_products_reviews_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products_reviews', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'content' => $this->text()->notNull(),
            'dt_add' => $this->integer(11)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
            'parent_id' => $this->integer(11)->defaultValue(0),
            'published' => $this->integer(1)->defaultValue(0),
            'rating' => $this->integer(11)->notNull()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('products_reviews');
    }
}
