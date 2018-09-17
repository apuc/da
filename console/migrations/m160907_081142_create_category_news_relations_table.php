<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_news_relations`.
 */
class m160907_081142_create_category_news_relations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_news_relations', [
            'id' => $this->primaryKey(),
            'cat_id' => $this->integer(11),
            'new_id' => $this->integer(11),
        ]);

        $this->addForeignKey('category_relations_fk', 'category_news_relations', 'cat_id', 'category_news', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('new_relations_fk', 'category_news_relations', 'new_id', 'news', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('category_relations_fk', 'category_news_relations');
        $this->dropForeignKey('new_relations_fk', 'category_news_relations');
        $this->dropTable('category_news_relations');
    }
}
