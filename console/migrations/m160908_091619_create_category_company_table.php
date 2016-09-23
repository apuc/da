<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_company`.
 */
class m160908_091619_create_category_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_company', [
            'id' => $this->primaryKey(),
            'title' => $this->string(255)->notNull(),
            'parent_id' => $this->integer(11),
            'descr' => $this->text(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'icon' => $this->string(255),
            'meta_title' => $this->string(255),
            'meta_descr' => $this->string(255),
            'slug' => $this->string(255),
            'lang_id' => $this->integer(11)->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_company');
    }
}
