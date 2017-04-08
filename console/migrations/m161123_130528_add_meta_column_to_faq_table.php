<?php

use yii\db\Migration;

/**
 * Handles adding meta to table `faq`.
 */
class m161123_130528_add_meta_column_to_faq_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('faq', 'meta_title', $this->string(255));
        $this->addColumn('faq', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('faq', 'meta_title');
        $this->dropColumn('faq', 'meta_descr');
    }
}
