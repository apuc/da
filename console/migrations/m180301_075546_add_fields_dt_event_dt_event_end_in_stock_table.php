<?php

use yii\db\Migration;

/**
 * Class m180301_075546_add_fields_dt_event_dt_event_end_in_stock_table
 */
class m180301_075546_add_fields_dt_event_dt_event_end_in_stock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('stock', 'dt_event', $this->date());
        $this->addColumn('stock', 'dt_event_end', $this->date());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('stock', 'dt_event_end');
        $this->dropColumn('stock', 'dt_event');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180301_075546_add_fields_dt_event_dt_event_end_in_stock_table cannot be reverted.\n";

        return false;
    }
    */
}
