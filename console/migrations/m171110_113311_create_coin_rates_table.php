<?php

use yii\db\Migration;

/**
 * Handles the creation of table `coin_rates`.
 * Has foreign keys to the tables:
 *
 * - `coin`
 */
class m171110_113311_create_coin_rates_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('coin_rates', [
            'id' => $this->primaryKey(),
            'coin_name' => $this->string()->notNull(),
            'date' => $this->date(),
            'usd' => $this->double(),
            'eur' => $this->double(),
            'rub' => $this->double(),
            'uah' => $this->double(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('coin_rates');
    }
}
