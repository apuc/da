<?php

use yii\db\Migration;

/**
 * Class m171122_090555_create_insert_role_stream
 */
class m171122_090555_create_insert_role_stream extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'Редактор парсинга',
            'type' => 1,
            'description' => 'Редактор парсинга',
        ]);

        $this->insert('auth_item', [
            'name' => 'Группы VK',
            'type' => 2,
            'description' => 'Группы VK',
        ]);

        $this->insert('auth_item', [
            'name' => 'Авторы VK',
            'type' => 2,
            'description' => 'Авторы VK',
        ]);

        $this->insert('auth_item', [
            'name' => 'Комментарии VK',
            'type' => 2,
            'description' => 'Комментарии VK',
        ]);

        $this->insert('auth_item', [
            'name' => 'Поток VK',
            'type' => 2,
            'description' => 'Поток VK',
        ]);

        $this->insert('auth_item', [
            'name' => 'На публикацию VK',
            'type' => 2,
            'description' => 'На публикацию VK',
        ]);

        $this->insert('auth_item', [
            'name' => 'Корзина VK',
            'type' => 2,
            'description' => 'Корзина VK',
        ]);

        $this->insert('auth_item', [
            'name' => 'Опубликованные VK',
            'type' => 2,
            'description' => 'Опубликованные VK',
        ]);

        $this->insert('auth_item', [
            'name' => 'Отложенные VK',
            'type' => 2,
            'description' => 'Отложенные VK',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->delete('auth_item', [
            'name' => 'Редактор парсинга'
        ]);

        $this->delete('auth_item', [
            'name' => 'Группы VK'
        ]);

        $this->delete('auth_item', [
            'name' => 'Авторы VK'
        ]);

        $this->delete('auth_item', [
            'name' => 'Комментарии VK'
        ]);

        $this->delete('auth_item', [
            'name' => 'Поток VK'
        ]);

        $this->delete('auth_item', [
            'name' => 'На публикацию VK'
        ]);

        $this->delete('auth_item', [
            'name' => 'Корзина VK'
        ]);

        $this->delete('auth_item', [
            'name' => 'Опубликованные VK'
        ]);

        $this->delete('auth_item', [
            'name' => 'Отложенные VK'
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171122_090555_create_insert_role_stream cannot be reverted.\n";

        return false;
    }
    */
}
