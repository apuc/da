<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stock`.
 */
class m170313_081234_create_stock_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('stock', [
            'id' => $this->primaryKey(),
            'title'=>$this->string('255')->notNull(),
            'content'=>$this->text(),
            'main'=>$this->integer(1)->defaultValue(0),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('stock');
    }
}
