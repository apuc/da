<?php

class m220603_161616_make_missing_person_columns_nullable extends \yii\db\Migration
{
    public function up()
    {
        $this->alterColumn('missing_person', 'city_id', $this->integer()->unsigned()->null());
    }
}