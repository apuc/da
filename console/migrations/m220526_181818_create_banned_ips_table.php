<?php

class m220526_181818_create_banned_ips_table extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('banned_ips', [
            'id' => $this->primaryKey(),
            'ip_mask' => $this->string(16)->notNull(),
        ]);
    }
}