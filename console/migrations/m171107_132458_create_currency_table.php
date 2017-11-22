<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m171107_132458_create_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'num_code' => $this->integer(11)->notNull(),
            'char_code' => $this->string(3)->notNull(),
            'name' => $this->text(),
            'status' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('currency');
    }
}
