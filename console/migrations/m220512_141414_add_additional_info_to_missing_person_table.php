<?php

class m220512_141414_add_additional_info_to_missing_person_table extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('missing_person', 'additional_info', $this->text());
    }

    public function down()
    {
        $this->dropColumn('missing_person', 'additional_info');
    }

}