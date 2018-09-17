<?php

use yii\db\Migration;

/**
 * Handles the creation for table `faq_category_relations`.
 */
class m161020_113714_create_faq_category_relations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_faq_relations', [
            'id' => $this->primaryKey(),
            'cat_id' => $this->integer(11),
            'faq_id' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_faq_relations');
    }
}
