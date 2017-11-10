<?php

use yii\db\Migration;

/**
 * Handles the creation of table `coin`.
 */
class m171109_161542_create_coin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('coin', [
            'id' => $this->primaryKey(),
            'coin_id' => $this->integer(11)->notNull(),
            'url' => $this->string(),
            'image_url' => $this->string(),
            'name' => $this->string()->notNull(),
            'symbol' => $this->string(),
            'coin_name' => $this->string(),
            'full_name' => $this->string(),
            'algorithm' => $this->string(),
            'proof_type' => $this->string(),
            'fully_premined' => $this->integer(1),
            'total_coin_supply' => $this->string(),
            'pre_mined_value' => $this->double(),
            'total_coins_free_float' => $this->double(),
            'sort_order' => $this->integer(),
            'sponsored' => $this->integer(1),
            'status' => $this->integer(1)->defaultValue(0)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('coin');
    }
}
