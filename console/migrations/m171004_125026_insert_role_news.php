<?php

use yii\db\Migration;

class m171004_125026_insert_role_news extends Migration
{


    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'Редактор новостей',
            'type' => 1,
            'description' => 'Добавление и редактирование новостей',
        ]);
    }

    public function down()
    {
        $this->delete('auth_item', [
            'name' => 'Добавление и редактирование новостей'
        ]);
    }


    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m171004_125026_insert_role_news cannot be reverted.\n";

        return false;
    }*/
}
