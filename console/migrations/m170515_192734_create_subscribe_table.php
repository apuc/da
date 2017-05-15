<?php

use yii\db\Migration;

/**
 * Handles the creation of table `subscribe`.
 */
class m170515_192734_create_subscribe_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('subscribe', [
            'id' => $this->primaryKey(),
            'email' => $this->string(255)->notNull(),
            'status' => $this->integer(1)->defaultValue(0),
            'dt_add' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('subscribe');
    }
}
