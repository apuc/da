<?php

class m220525_121212_add_user_id_and_user_ip_to_missing_person_table extends \yii\db\Migration
{
    public function up()
    {
        $this->addColumn('missing_person', 'user_id', $this->integer()->null());
        $this->addColumn('missing_person', 'user_ip', $this->string()->null());
    }

    public function down()
    {
        $this->dropColumn('missing_person', 'user_id');
        $this->dropColumn('missing_person', 'user_ip');
    }
}