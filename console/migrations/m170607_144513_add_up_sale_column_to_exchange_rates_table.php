<?php

use yii\db\Migration;

/**
 * Handles adding up_sale to table `exchange_rates`.
 */
class m170607_144513_add_up_sale_column_to_exchange_rates_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('exchange_rates', 'up_sale', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('exchange_rates', 'up_sale');
    }
}
