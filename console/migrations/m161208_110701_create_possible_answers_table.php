<?php

use yii\db\Migration;

/**
 * Handles the creation for table `possible_answers`.
 */
class m161208_110701_create_possible_answers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('possible_answers', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('possible_answers');
    }
}
