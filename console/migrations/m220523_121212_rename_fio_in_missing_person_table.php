<?php

class m220523_121212_rename_fio_in_missing_person_table extends \yii\db\Migration
{
    function up()
    {
        $this->renameColumn('missing_person', 'FIO', 'fio');
    }
}