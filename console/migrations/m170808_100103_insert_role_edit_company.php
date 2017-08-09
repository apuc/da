<?php

use yii\db\Migration;

class m170808_100103_insert_role_edit_company extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170808_100103_insert_role_edit_company cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'Редактор компаний',
            'type' => 1,
            'description' => 'Добавление и редактирование компаний',
        ]);

        $this->insert('auth_item', [
            'name' => 'Заявки компаний',
            'type' => 2,
        ]);

        $this->insert('auth_item', [
            'name' => 'Категории компаний',
            'type' => 2,
        ]);

        $this->insert('auth_item', [
            'name' => 'Топ компаний',
            'type' => 2,
        ]);

        $this->insert('auth_item', [
            'name' => 'Развлечения компаний',
            'type' => 2,
        ]);

        $this->insert('auth_item', [
            'name' => 'Рекомендуем компаний',
            'type' => 2,
        ]);

        $this->insert('auth_item', [
            'name' => 'Отзывы компаний',
            'type' => 2,
        ]);

        $this->insert('auth_item', [
            'name' => 'Популярные акции компаний',
            'type' => 2,
        ]);

        $this->insert('auth_item', [
            'name' => 'Социальные сети компаний',
            'type' => 2,
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'Редактор компаний',
            'child' => 'Компании'
        ]);
    }

    public function down()
    {
        $this->delete('auth_item', [
            'name' => 'Редактор компаний'
        ]);

        $this->delete('auth_item', [
            'name' => 'Заявки компаний',
        ]);

        $this->delete('auth_item', [
            'name' => 'Категории компаний',
        ]);

        $this->delete('auth_item', [
            'name' => 'Топ компаний',
        ]);

        $this->delete('auth_item', [
            'name' => 'Развлечения компаний',
        ]);

        $this->delete('auth_item', [
            'name' => 'Рекомендуем компаний',
        ]);

        $this->delete('auth_item', [
            'name' => 'Отзывы компаний',
        ]);

        $this->delete('auth_item', [
            'name' => 'Популярные акции компаний',
        ]);

        $this->delete('auth_item', [
            'name' => 'Социальные сети компаний',
        ]);

        $this->delete('auth_item_child', [
            'parent' => 'Редактор компаний',
            'child' => 'Компании'
        ]);
    }

}
