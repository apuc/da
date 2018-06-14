<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_periods`.
 */
class m180614_062007_create_service_periods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service_periods', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11),
            'start_time' => $this->string(10),
            'end_time' => $this->string(10),
            'week_days' => $this->string(200),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('service_periods');
    }
}
