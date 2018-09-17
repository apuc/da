<?php

use yii\db\Migration;

/**
 * Class m180606_082658_rename_google_plus_posts_columns
 */
class m180606_082658_rename_google_plus_posts_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('google_plus_posts', 'title', 'content');
        $this->addColumn('google_plus_posts', 'title', $this->string(500));
        $this->dropColumn('google_plus_posts', 'likes');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180606_082658_rename_google_plus_posts_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180606_082658_rename_google_plus_posts_columns cannot be reverted.\n";

        return false;
    }
    */
}
