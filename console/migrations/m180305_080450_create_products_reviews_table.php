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
            'published' => $this->integer(1)->defaultValue(0),
            'rating' => $this->integer(11)->notNull()
        ]);

        $this->addForeignKey(
            'products_reviews_to_user_fk',
            'products_reviews',
            'user_id',
            'user',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'products_reviews_to_product_fk',
            'products_reviews',
            'product_id',
            'products',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('products_reviews_to_user_fk', 'products_reviews');
        $this->dropForeignKey('products_reviews_to_product_fk', 'products_reviews');

        $this->dropTable('products_reviews');
    }
}
