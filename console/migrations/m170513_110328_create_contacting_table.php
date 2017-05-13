<?php

use yii\db\Migration;

/**
 * Handles the creation of table `treatment`.
 */
class m170513_110328_create_contacting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('contacting', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'type' => $this->string(32)->notNull(),
            'content' => $this->string(1000)->notNull(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('contacting');
    }
}
