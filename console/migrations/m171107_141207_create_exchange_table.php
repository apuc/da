<?php

use yii\db\Migration;

/**
 * Handles the creation of table `exchange`.
 */
class m171107_141207_create_exchange_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('exchange', [
            'id' => $this->primaryKey(),
            'num_code' => $this->integer(11)->notNull()->unique(),
            'char_code' => $this->string(3)->notNull()->unique(),
            'nominal' => $this->integer(11),
            'name' => $this->text(),
            'value' => $this->double()->notNull(),
            'previous' => $this->double()->notNull(),
            'date' => $this->integer(10)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('exchange');
    }
}
