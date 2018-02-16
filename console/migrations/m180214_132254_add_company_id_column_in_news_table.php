<?php

use yii\db\Migration;

/**
 * Class m180214_132254_add_company_id_column_in_news_table
 */
class m180214_132254_add_company_id_column_in_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn('news', 'company_id', $this->integer(11)->defaultValue(null));
        // creates index for column `company_id`
        $this->createIndex(
            'idx-news-company_id',
            'news',
            'company_id'
        );

        // add foreign key for table `company`
        $this->addForeignKey(
            'fk-news-company_id',
            'news',
            'company_id',
            'company',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'company_id');

        // drops foreign key for table `company`
        $this->dropForeignKey(
            'fk-news-company_id',
            'news'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-news-company_id',
            'news'
        );
    }
}
