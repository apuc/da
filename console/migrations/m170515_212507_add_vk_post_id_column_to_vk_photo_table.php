<?php

use yii\db\Migration;

/**
 * Handles adding vk_post_id to table `vk_photo`.
 */
class m170515_212507_add_vk_post_id_column_to_vk_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('vk_photo', 'vk_post_id', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('vk_photo', 'vk_post_id');
    }
}
