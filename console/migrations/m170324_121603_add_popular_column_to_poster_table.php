<?php

use yii\db\Migration;

/**
 * Handles adding popular to table `poster`.
 */
class m170324_121603_add_popular_column_to_poster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('poster', 'popular', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('poster', 'popular');
    }
}
