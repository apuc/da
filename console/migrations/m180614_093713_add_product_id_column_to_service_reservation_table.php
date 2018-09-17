<?php

use yii\db\Migration;

/**
 * Handles adding product_id to table `service_reservation`.
 */
class m180614_093713_add_product_id_column_to_service_reservation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('service_reservation', 'product_id', $this->integer(11)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('service_reservation', 'product_id');
    }
}
