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
        $this->createTable('faq_category', [
            'id' => $this->primaryKey(),
            'title' => $this->varchar(255),
            'parent_id' => $this->int(11),
            'slug' => $this->varchar(255),
            'dt_add' => $this->int(11),
            'dt_update' => $this->int(11),
            'icon' => $this->varchar(255),
            'type' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('faq_category');
    }
}
