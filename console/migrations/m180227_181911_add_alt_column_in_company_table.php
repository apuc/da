<?php

use yii\db\Migration;

/**
 * Class m180227_181911_add_alt_column_in_company_table
 */
class m180227_181911_add_alt_column_in_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('company', 'alt', $this->string(255)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('company', 'alt');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180227_181911_add_alt_column_in_company_table cannot be reverted.\n";

        return false;
    }
    */
}
