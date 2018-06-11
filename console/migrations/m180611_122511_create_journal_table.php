<?php

use yii\db\Migration;

/**
 * Handles the creation of table `journal`.
 */
class m180611_122511_create_journal_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('journal', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->defaultValue(null),
            'photo' => $this->string(255)->defaultValue(null),
            'iframe' => $this->text()->defaultValue(null),
            'dt_add' => $this->integer(30)->defaultValue(null),
            'status' => $this->integer(3)->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('journal');
    }
}
