<?php

use yii\db\Migration;

/**
 * Handles adding dt_event to table `poster`.
 */
class m161027_094719_add_dt_event_column_to_poster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('poster', 'dt_event', $this->integer(11)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('poster', 'dt_event');
    }
}
