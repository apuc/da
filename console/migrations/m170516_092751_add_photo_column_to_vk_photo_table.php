<?php

use yii\db\Migration;

/**
 * Handles adding photo to table `vk_photo`.
 */
class m170516_092751_add_photo_column_to_vk_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('vk_photo', 'photo_130', $this->string(255));
        $this->addColumn('vk_photo', 'photo_604', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('vk_photo', 'photo_130');
        $this->dropColumn('vk_photo', 'photo_604');
    }
}
