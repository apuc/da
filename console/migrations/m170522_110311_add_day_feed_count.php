<?php

use yii\db\Migration;

class m170522_110311_add_day_feed_count extends Migration
{
    public function up()
    {
        $this->insert('key_value', [
            'key' => 'day_feed_count',
            'value' => 12,
            'dt_add' => time(),
            'dt_update' => time(),
        ]);
    }

    public function down()
    {
        $this->delete('key_value', [
            'key' => 'day_feed_count',
        ]);
    }

}
