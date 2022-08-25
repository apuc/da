<?php

class m220511_171717_create_forced_views_table extends \yii\db\Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('forced_views', [
            'id' => $this->primaryKey(),
            'news_id' => $this->integer()->notNull(),
            'views' => $this->integer()->notNull()->defaultValue(0),
        ]);

        $this->addForeignKey('forced_views_news_foreign', 'forced_views', 'news_id', 'news', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('forced_views');
    }
}