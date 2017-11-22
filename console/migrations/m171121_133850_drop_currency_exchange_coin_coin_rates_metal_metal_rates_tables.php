<?php

use yii\db\Migration;

/**
 * Class m171121_133850_drop_currency_exchange_coin_coin_rates_metal_metal_rates_tables
 */
class m171121_133850_drop_currency_exchange_coin_coin_rates_metal_metal_rates_tables extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        // drops foreign key for table `metal`
        $this->dropForeignKey(
            'fk-metal_rates-metal_id',
            'metal_rates'
        );

        // drops index for column `metal_id`
        $this->dropIndex(
            'idx-metal_rates-metal_id',
            'metal_rates'
        );

        $this->dropTable('metal_rates');

        $this->dropTable('metal');

        $this->dropTable('coin_rates');

        $this->dropTable('coin');

        $this->dropTable('exchange');

        $this->dropTable('currency');
    }

    public function down()
    {
        return true;
    }
}
