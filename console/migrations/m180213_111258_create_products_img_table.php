<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products_img`.
 */
class m180213_111258_create_products_img_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products_img', [
            'id' => $this->primaryKey(),
            'img' => $this->string(255)->notNull(),
            'img_thumb' => $this->string(255)->notNull(),
            'product_id' => $this->integer(11)->notNull(),
        ]);

        $this->addForeignKey(
            'products_img_products_fk',
            'products_img',
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
        $this->dropForeignKey('products_img_products_fk', 'products_img');
        $this->dropTable('products_img');
    }
}
