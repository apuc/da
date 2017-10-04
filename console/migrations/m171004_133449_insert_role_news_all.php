<?php

use yii\db\Migration;

class m171004_133449_insert_role_news_all extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171004_133449_insert_role_news_all cannot be reverted.\n";

        return false;
    }*/


    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'Категории новостей',
            'type' => 2,
            'description' => 'Категории новостей',
        ]);

        $this->insert('auth_item', [
            'name' => 'Главная новость',
            'type' => 2,
            'description' => 'Главная новость',
        ]);
    }

    public function down()
    {
        $this->delete('auth_item', [
            'name' => 'Категории новостей'
        ]);

        $this->delete('auth_item', [
            'name' => 'Главная новость'
        ]);
    }
}
