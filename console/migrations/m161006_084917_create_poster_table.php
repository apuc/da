<?php

use yii\db\Migration;

/**
 * Handles the creation for table `poster`.
 */
class m161006_084917_create_poster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('poster', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'slug' => $this->string(255),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'descr' => $this->text(),
            'short_descr' => $this->text(),
            'price' => $this->string(255),
            'start' => $this->string(512),
            'views' => $this->integer(11)->defaultValue(0),
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
        $this->dropTable('poster');
    }
}
