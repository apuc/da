<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages_group`.
 */
class m170506_075956_create_pages_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pages_group', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pages_group');
    }
}
