<?php

use yii\db\Migration;

/**
 * Handles adding hot_new to table `news`.
 */
class m170326_090049_add_hot_new_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'hot_new', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'hot_new');
    }
}
