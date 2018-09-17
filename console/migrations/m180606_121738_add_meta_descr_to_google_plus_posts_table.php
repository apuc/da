<?php

use yii\db\Migration;

/**
 * Class m180606_121738_add_meta_descr_to_google_plus_posts_table
 */
class m180606_121738_add_meta_descr_to_google_plus_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('google_plus_posts', 'meta_descr', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180606_121738_add_meta_descr_to_google_plus_posts_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180606_121738_add_meta_descr_to_google_plus_posts_table cannot be reverted.\n";

        return false;
    }
    */
}
