<?php

use yii\db\Migration;

/**
 * Handles adding exclude_popular to table `news`.
 */
class m161209_083832_add_exclude_popular_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'exclude_popular', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'exclude_popular');
    }
}
