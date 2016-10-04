<?php

use yii\db\Migration;

/**
 * Handles adding dt_public to table `news`.
 */
class m160926_181548_add_dt_public_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news', 'dt_public', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'dt_public');
    }
}
