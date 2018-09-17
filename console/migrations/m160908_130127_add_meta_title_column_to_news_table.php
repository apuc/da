<?php

use yii\db\Migration;

/**
 * Handles adding meta_title to table `news`.
 */
class m160908_130127_add_meta_title_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'meta_title', $this->string(255));
        $this->addColumn('news', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'meta_title');
        $this->dropColumn('news', 'meta_descr');
    }
}
