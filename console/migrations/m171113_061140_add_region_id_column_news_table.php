<?php

use yii\db\Migration;

/**
 * Class m171113_061140_add_region_id_column_news_table
 */
class m171113_061140_add_region_id_column_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('news', 'region_id', $this->integer(11)->defaultValue(null));
    }

    public function down()
    {
        $this->dropColumn('news', 'region_id');
    }

}
