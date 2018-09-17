<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company_tariff_order`.
 */
class m170704_134603_create_company_tariff_order_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company_tariff_order', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(11)->notNull(),
            'tariff_id' => $this->integer(11)->notNull(),
            'dt_end_tariff' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company_tariff_order');
    }
}
