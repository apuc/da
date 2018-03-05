<?php

use yii\db\Migration;

/**
 * Class m180301_073832_rename_dt_event_in_stock_table
 */
class m180301_073832_rename_dt_event_in_stock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('stock', 'dt_event', 'dt_event_description');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('stock', 'dt_event_description', 'dt_event');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180301_073832_rename_dt_event_in_stock_table cannot be reverted.\n";

        return false;
    }
    */
}
