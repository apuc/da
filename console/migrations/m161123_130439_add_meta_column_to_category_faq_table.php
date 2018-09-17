<?php

use yii\db\Migration;

/**
 * Handles adding meta to table `category_faq`.
 */
class m161123_130439_add_meta_column_to_category_faq_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category_faq', 'meta_title', $this->string(255));
        $this->addColumn('category_faq', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category_faq', 'meta_title');
        $this->dropColumn('category_faq', 'meta_descr');
    }
}
