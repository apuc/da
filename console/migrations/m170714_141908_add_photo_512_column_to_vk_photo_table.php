<?php

use yii\db\Migration;

/**
 * Handles adding photo_512 to table `vk_photo`.
 */
class m170714_141908_add_photo_512_column_to_vk_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('vk_photo', 'photo_512', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('vk_photo', 'photo_512');
    }
}
