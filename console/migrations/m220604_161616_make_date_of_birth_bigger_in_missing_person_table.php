<?php

class m220604_161616_make_date_of_birth_bigger_in_missing_person_table extends \yii\db\Migration
{
    public function up()
    {
        $this->alterColumn('missing_person', 'date_of_birth', $this->bigInteger()->null());
    }
}