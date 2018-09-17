<?php

use yii\db\Migration;

/**
 * Handles the creation of table `messenger`.
 */
class m180314_134721_create_messenger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('messenger', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'icon' => $this->string(255),
            'link' => $this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('messenger');
    }
}
