<?php

use yii\db\Migration;

/**
 * Class m180227_155834_add_alt_column_in_news_table
 */
class m180227_155834_add_alt_column_in_news_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('news', 'alt', $this->text()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('news', 'alt');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180227_155834_add_alt_column_in_news_table cannot be reverted.\n";

        return false;
    }
    */
}
