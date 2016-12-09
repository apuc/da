<?php

use yii\db\Migration;

/**
 * Handles adding question_id to table `possible_answers`.
 */
class m161208_125200_add_question_id_column_to_possible_answers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('possible_answers', 'question', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('possible_answers', 'question');
    }
}
