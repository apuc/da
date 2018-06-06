<?php

use yii\db\Migration;

/**
 * Class m180605_082303_rename_publish_column
 */
class m180605_082303_rename_publish_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('google_plus_posts', 'published', 'dt_publish');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180605_082303_rename_publish_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180605_082303_rename_publish_column cannot be reverted.\n";

        return false;
    }
    */
}
