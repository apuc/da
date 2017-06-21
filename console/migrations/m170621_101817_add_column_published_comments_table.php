<?php

use yii\db\Migration;

class m170621_101817_add_column_published_comments_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('comments', 'published', $this->integer(1)->notNull()->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('comments', 'published');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170621_101817_add_column_published_comments_table cannot be reverted.\n";

        return false;
    }
    */
}
