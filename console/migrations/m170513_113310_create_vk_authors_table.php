<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vk_authors`.
 */
class m170513_113310_create_vk_authors_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vk_authors', [
            'id' => $this->primaryKey(),
            'vk_id' => $this->integer(11)->notNull(),
            'first_name' => $this->string(255),
            'last_name' => $this->string(255),
            'sex' => $this->integer(1),
            'screen_name' => $this->string(255),
            'photo' => $this->string(255),
            'user_id' => $this->integer(11)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vk_authors');
    }
}
