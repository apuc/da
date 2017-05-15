<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vk_photo`.
 */
class m170513_114702_create_vk_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vk_photo', [
            'id' => $this->primaryKey(),
            'vk_id' => $this->integer(11)->notNull(),
            'vk_user_id' => $this->integer(11),
            'photo_75' => $this->string(255),
            'photo_807' => $this->string(255),
            'photo_1280' => $this->string(255),
            'post_id' => $this->integer(11),
            'owner_id' => $this->integer(11),
            'access_key' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vk_photo');
    }
}
