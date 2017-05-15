<?php

use yii\db\Migration;

/**
 * Handles the creation of table `vk_groups`.
 */
class m170513_112309_create_vk_groups_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('vk_groups', [
            'id' => $this->primaryKey(),
            'domain' => $this->string(255)->notNull(),
            'vk_id' => $this->string(255)->notNull(),
            'status' => $this->integer(1)->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('vk_groups');
    }
}
