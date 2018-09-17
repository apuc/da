<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency_coin`.
 */
class m171121_134938_create_currency_coin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('currency_coin', [
            'id' => $this->primaryKey(),
            'currency_id' => $this->integer(11)->notNull(),
            'url' => $this->string(255),
            'image_url' => $this->string(255),
            'symbol' => $this->string(255),
            'full_name' => $this->string(255),
            'algorithm' => $this->string(255),
            'proof_type' =>$this->string(255),
            'fully_premined' => $this->boolean(),
            'total_coin_supply' => $this->string(255),
            'pre_mined_value' => $this->double(),
            'total_coins_free_float' => $this->double(),
            'sort_order' => $this->integer(11),
            'sponsored' => $this->boolean(),
        ]);

        // creates index for column `currency_id`
        $this->createIndex(
            'idx-currency_coin-currency_id',
            'currency_coin',
            'currency_id'
        );

        // add foreign key for table `currency`
        $this->addForeignKey(
            'fk-currency_coin-currency_id',
            'currency_coin',
            'currency_id',
            'currency',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `currency`
        $this->dropForeignKey(
            'fk-currency_coin-currency_id',
            'currency_coin'
        );

        // drops index for column `currency_id`
        $this->dropIndex(
            'idx-currency_coin-currency_id',
            'currency_coin'
        );

        $this->dropTable('currency_coin');
    }
}
