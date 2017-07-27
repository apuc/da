<?php

use yii\db\Migration;

/**
 * Handles adding name to table `vk_groups`.
 */
class m170718_141514_add_name_column_to_vk_groups_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('vk_groups', 'name', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('vk_groups', 'name');
    }
}
