<?php

use yii\db\Migration;

/**
 * Handles adding main_slider to table `news`.
 */
class m170310_105916_add_main_slider_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'main_slider', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'main_slider');
    }
}
