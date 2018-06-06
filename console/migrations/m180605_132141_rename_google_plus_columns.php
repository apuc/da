<?php

use yii\db\Migration;

/**
 * Class m180605_132141_rename_google_plus_columns
 */
class m180605_132141_rename_google_plus_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('google_plus_posts', 'likes_count', 'likes');
        $this->renameColumn('google_plus_posts', 'reposts_count', 'views');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180605_132141_rename_google_plus_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180605_132141_rename_google_plus_columns cannot be reverted.\n";

        return false;
    }
    */
}
