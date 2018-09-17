<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_posts_consulting`.
 */
class m161024_120730_create_category_posts_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_posts_consulting', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'parent_id' => $this->integer(11)->defaultValue(0),
            'slug' => $this->string(255),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'icon' => $this->string(255),
            'type' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_posts_consulting');
    }
}
