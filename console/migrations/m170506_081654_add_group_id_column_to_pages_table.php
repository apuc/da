<?php

use yii\db\Migration;

/**
 * Handles adding group_id to table `pages`.
 */
class m170506_081654_add_group_id_column_to_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('pages', 'group_id', $this->integer(11)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('pages', 'group_id');
    }
}
