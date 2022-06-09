<?php

class m220609_151515_make_coordinates_longer_in_news_table extends \yii\db\Migration
{
    public function up()
    {
        $this->alterColumn('news', 'coordinates', $this->string(255)->null()->defaultValue(null));
    }
}