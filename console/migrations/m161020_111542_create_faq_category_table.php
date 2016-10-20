<?php

use yii\db\Migration;

/**
 * Handles the creation for table `faq_category`.
 */
class m161020_111542_create_faq_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_faq', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255),
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
        $this->dropTable('category_faq');
    }
}
