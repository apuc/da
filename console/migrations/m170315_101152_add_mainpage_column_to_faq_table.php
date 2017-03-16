<?php

use yii\db\Migration;

/**
 * Handles adding mainpage to table `faq`.
 */
class m170315_101152_add_mainpage_column_to_faq_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('faq', 'main_page', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('faq', 'main_page');
    }
}
