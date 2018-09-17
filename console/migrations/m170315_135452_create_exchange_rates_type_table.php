<?php

use yii\db\Migration;

/**
 * Handles the creation of table `exchange_rates_type`.
 */
class m170315_135452_create_exchange_rates_type_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('exchange_rates_type', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('exchange_rates_type');
    }
}
