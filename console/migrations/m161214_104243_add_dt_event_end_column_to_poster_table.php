<?php

use yii\db\Migration;

/**
 * Handles adding dt_event_end to table `poster`.
 */
class m161214_104243_add_dt_event_end_column_to_poster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('poster', 'dt_event_end', $this->integer(11)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('poster', 'dt_event_end');
    }
}
