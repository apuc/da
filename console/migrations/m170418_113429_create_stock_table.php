<?php

use yii\db\Migration;

/**
 * Handles the creation of table `stock`.
 */
class m170418_113429_create_stock_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropTable('stock');

        $this->createTable('stock', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'photo' => $this->string(255),
            'short_descr' => $this->text(),
            'descr' => $this->text(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'status' => $this->integer(2)->defaultValue(0),
            'dt_event' => $this->string(255),
            'link' => $this->string(255)->notNull(),
            'main' => $this->integer(1)->defaultValue(0)
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
