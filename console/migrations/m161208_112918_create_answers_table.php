<?php

use yii\db\Migration;

/**
 * Handles the creation for table `answers`.
 */
class m161208_112918_create_answers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('answers', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer(11),
            'possible_answers_id' => $this->integer(11),
            'user_id' => $this->integer(11)->defaultValue(0),
            'dt_add' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('answers');
    }
}
