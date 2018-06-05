<?php

use yii\db\Migration;

/**
 * Class m180605_094629_add_columns_to_google_plus_posts_table
 */
class m180605_094629_add_columns_to_google_plus_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('google_plus_posts', 'likes_count', $this->integer(11)->defaultValue(null));
        $this->addColumn('google_plus_posts', 'reposts_count', $this->integer(11)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180605_094629_add_columns_to_google_plus_posts_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180605_094629_add_columns_to_google_plus_posts_table cannot be reverted.\n";

        return false;
    }
    */
}
