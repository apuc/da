<?php

use yii\db\Migration;

/**
 * Handles the creation of table `exchange_rates`.
 */
class m170315_135245_create_exchange_rates_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('exchange_rates', [
            'id' => $this->primaryKey(),
            'currencies' => $this->string(255)->notNull(),
            'buy' => $this->string(255)->notNull(),
            'sale' => $this->string(255)->notNull(),
            'type_id' => $this->integer(11),
            'up' => $this->integer(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('exchange_rates');
    }
}
