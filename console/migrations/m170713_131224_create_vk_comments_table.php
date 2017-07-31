<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vk_comments`.
 */
class m170713_131224_create_vk_comments_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vk_comments', [
            'id' => $this->primaryKey(),
            'vk_id' => $this->string(255),
            'from_id' => $this->integer(11),
            'owner_id' => $this->integer(11),
            'post_id' => $this->integer(11),
            'dt_add' => $this->integer(11),
            'text' => $this->text(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vk_comments');
    }
}
