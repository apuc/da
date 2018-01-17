<?php

use yii\db\Migration;

/**
 * Class m180117_112859_insert_count_news_page_dnr_key_value_table
 */
class m180117_112859_insert_count_news_page_dnr_key_value_table extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('key_value', [
            'key' => 'day_feed_count_dnr',
            'value' => '15',
        ]);
    }

    public function down()
    {
        $this->delete('key_value', [
            'key' => 'day_feed_count_dnr',
        ]);
    }
}
