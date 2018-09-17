<?php

use yii\db\Migration;

/**
 * Handles adding rss to table `news`.
 */
class m170116_074509_add_rss_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'rss', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'rss');
    }
}
