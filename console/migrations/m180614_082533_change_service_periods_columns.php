<?php

use yii\db\Migration;

/**
 * Class m180614_082533_change_service_periods_columns
 */
class m180614_082533_change_service_periods_columns extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('service_periods', 'start_time');
        $this->dropColumn('service_periods', 'end_time');
        $this->addColumn('service_periods', 'start', $this->time()->notNull());
        $this->addColumn('service_periods', 'end', $this->time()->notNull());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180614_082533_change_service_periods_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180614_082533_change_service_periods_columns cannot be reverted.\n";

        return false;
    }
    */
}
