<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tw_pages`.
 */
class m180221_210426_create_tw_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tw_pages', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
            'tw_id' => $this->integer(11),
            'screen_name' => $this->string(255)->notNull(),
            'icon' => $this->string(255),
            'status' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tw_pages');
    }
}
