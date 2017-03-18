<?php

use yii\db\Migration;

/**
 * Handles the creation of table `situation_status`.
 */
class m170315_090902_create_situation_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('situation_status', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'circle' => $this->string(255)->notNull(),
            'border' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('situation_status');
    }
}
