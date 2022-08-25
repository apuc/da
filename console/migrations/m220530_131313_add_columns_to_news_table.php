<?php

class m220530_131313_add_columns_to_news_table extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('news', 'is_event', $this->tinyInteger()->defaultValue(0));
        $this->addColumn('news', 'coordinates', $this->string(32)->null()->defaultValue(null));
        $this->addColumn('news', 'event_time', $this->integer()->null()->defaultValue(null));
        $this->addColumn('news', 'type', $this->integer()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('news', 'is_event');
        $this->dropColumn('news', 'coordinates');
        $this->dropColumn('news', 'event_time');
        $this->dropColumn('news', 'type');
    }
}