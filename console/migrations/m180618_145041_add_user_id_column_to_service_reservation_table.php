<?php

use yii\db\Migration;

/**
 * Handles adding user_id to table `service_reservation`.
 */
class m180618_145041_add_user_id_column_to_service_reservation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('service_reservation', 'user_id', $this->integer(11)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('service_reservation', 'user_id');
    }
}
