<?php

use yii\db\Migration;

/**
 * Handles the creation of table `like_products`.
 */
class m180303_134144_create_like_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('like_products', [
            'product_id' => $this->integer(11)->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'dt_add' => $this->integer(11)->notNull(),
        ]);

        $this->addForeignKey(
            'like_products_to_products_fk',
            'like_products',
            'product_id',
            'products',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'like_products_to_user_fk',
            'like_products',
            'user_id',
            'user',
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
        $this->dropForeignKey('like_products_to_products_fk', 'like_products');
        $this->dropForeignKey('like_products_to_user_fk', 'like_products');
        $this->dropTable('like_products');
    }
}
