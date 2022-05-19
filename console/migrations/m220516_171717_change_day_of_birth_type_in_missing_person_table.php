<?php

class m220516_171717_change_day_of_birth_type_in_missing_person_table extends \yii\db\Migration
{
    public function up(){
        $this->alterColumn('missing_person', 'date_of_birth', $this->integer());//timestamp new_data_type
    }
}