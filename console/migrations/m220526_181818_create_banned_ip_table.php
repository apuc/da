<?php

class m220526_181818_create_banned_ip_table extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('banned_ip', [
            'id' => $this->primaryKey(),
            'ip_mask' => $this->string(16)->notNull(),
        ]);
    }
}