<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category_fields`.
 */
class m180119_091901_create_category_fields_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_fields', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer(11)->notNull(),
            'fields_id' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_fields');
    }
}
