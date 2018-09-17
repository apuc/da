<?php

use yii\db\Migration;

/**
 * Handles the creation of table `situation`.
 */
class m170315_090654_create_situation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('situation', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'report_time' => $this->string(255),
            'descr' => $this->text(),
            'situation_status_id' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('situation');
    }
}
