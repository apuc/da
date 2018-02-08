<?php

use yii\db\Migration;

/**
 * Handles the creation of table `products`.
 */
class m180208_075244_create_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('products', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255)->notNull(),
            'company_id' => $this->integer(11)->notNull(),
            'category_id' => $this->integer(11)->notNull(),
            'description' => $this->text()->notNull(),
            'cover' => $this->string(255),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
        ]);

        $this->addForeignKey(
            'products_company_fk',
            'products',
            'company_id',
            'company',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'products_category_fk',
            'products',
            'category_id',
            'category_shop',
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
        $this->dropForeignKey('products_company_fk', 'products');
        $this->dropForeignKey('products_category_fk', 'products');
        $this->dropTable('products');
    }
}
