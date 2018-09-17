<?php

use yii\db\Migration;

/**
 * Handles adding author to table `news`.
 */
class m170322_124902_add_author_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'author', $this->string(64));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'author');
    }
}
