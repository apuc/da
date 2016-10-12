<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_poster`.
 */
class m161006_090553_create_category_poster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_poster', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(11)->defaultValue(0),
            'title' => $this->string(255)->notNull(),
            'descr' => $this->text(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'icon' => $this->string(255),
            'meta_title' => $this->string(255),
            'meta_descr' => $this->string(255),
            'slug' => $this->string(255),
            'lang_id' => $this->integer(2)->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_poster');
    }
}
