<?php

use yii\db\Migration;

/**
 * Handles adding region_id to table `poster`.
 */
class m171208_135018_add_region_id_column_to_poster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('poster', 'region_id', $this->integer(11)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('poster', 'region_id');
    }
}
