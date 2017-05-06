<?php

use yii\db\Migration;

class m170506_104414_insert_pages_pages_table extends Migration
{
    public function up()
    {
        $this->insert('pages', [
            'title' => 'Электричество',
            'slug' => 'elektrichestvo',
            'group_id' => 9999
        ]);

        $this->insert('pages', [
            'title' => 'Отопление',
            'slug' => 'otoplenie',
            'group_id' => 9999
        ]);

        $this->insert('pages', [
        'title' => 'Газ',
        'slug' => 'gas',
        'group_id' => 9999
         ]);

        $this->insert('pages', [
        'title' => 'ЖКХ',
        'slug' => 'gkh',
        'group_id' => 9999
         ]);

        $this->insert('pages', [
        'title' => 'Вода',
        'slug' => 'voda',
        'group_id' => 9999
        ]);
    }

    public function down()
    {
        $this->delete('pages', ['title' => 'Электричество']);
        $this->delete('pages', ['title' => 'Отопление']);
        $this->delete('pages', ['title' => 'Газ']);
        $this->delete('pages', ['title' => 'ЖКХ']);
        $this->delete('pages', ['title' => 'Вода']);

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
