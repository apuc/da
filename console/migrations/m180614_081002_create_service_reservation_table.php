<?php

use yii\db\Migration;

/**
 * Handles the creation of table `service_reservation`.
 */
class m180614_081002_create_service_reservation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('service_reservation', [
            'id' => $this->primaryKey(),
            'start' => $this->time()->notNull(),
            'end' => $this->time()->notNull(),
            'date' => $this->date()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('service_reservation');
    }
}
