<?php

class m229526_131313_add_moderated_flag_to_missing_person extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('missing_person', 'moderated', $this->tinyInteger()->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('missing_person', 'moderated');
    }
}