<?php

use yii\db\Migration;

/**
 * Handles the creation for table `faq`.
 */
class m161020_105918_create_faq_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('faq', [
            'id' => $this->primaryKey(),
            'question' => $this->string(255)->notNull(),
            'answer' => $this->text(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'slug' => $this->string(255),
            'views' => $this->integer(8)->defaultValue(0),
            'user_id' => $this->integer(11),
            'type' => $this->string(255),
            'company_id' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('faq');
    }
}
