<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m170505_201225_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pages', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255),
            'content' => $this->text(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'status' => $this->integer(1)->defaultValue(0),
            'meta_title' => $this->string(255),
            'meta_descr' => $this->string(255),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('pages');
    }
}
