<?php

use yii\db\Migration;

class m170506_104352_insert_group_pages_group_table extends Migration
{
    public function up()
    {
        $this->insert('pages_group', [
            'id' => 9999,
            'title' => 'Тарифы ЖКХ',
            'slug' => 'tarifi-gkh',
        ]);
    }

    public function down()
    {
        $this->delete('pages_group', ['id' => 9999]);
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
