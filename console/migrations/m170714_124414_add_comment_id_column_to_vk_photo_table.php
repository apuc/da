<?php

use yii\db\Migration;

/**
 * Handles adding comment_id to table `vk_photo`.
 */
class m170714_124414_add_comment_id_column_to_vk_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('vk_photo', 'comment_id', $this->integer(11)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('vk_photo', 'comment_id');
    }
}
