<?php

use yii\db\Migration;

/**
 * Class m171122_073745_create_insert_role_afisha
 */
class m171122_073745_create_insert_role_afisha extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'Редактор афиш',
            'type' => 1,
            'description' => 'Добавление и редактирование афиш',
        ]);

        $this->insert('auth_item', [
            'name' => 'Афиша категории',
            'type' => 2,
            'description' => 'Афиша категории',
        ]);

        $this->insert('auth_item', [
            'name' => 'Главная Афиша',
            'type' => 2,
            'description' => 'Главная Афиша',
        ]);

        $this->insert('auth_item', [
            'name' => 'Баннер Афиша',
            'type' => 2,
            'description' => 'Баннер Афиша',
        ]);

        $this->insert('auth_item', [
            'name' => 'Может заинтересовать афиша',
            'type' => 2,
            'description' => 'Может заинтересовать афиша',
        ]);

        $this->insert('auth_item', [
            'name' => 'Верхнйи слайдер на странице афиш',
            'type' => 2,
            'description' => 'Верхнйи слайдер на странице афиш',
        ]);
    }

    public function down()
    {
        $this->delete('auth_item', [
            'name' => 'Редактор афиш'
        ]);

        $this->delete('auth_item', [
            'name' => 'Афиша категории'
        ]);

        $this->delete('auth_item', [
            'name' => 'Главная Афиша'
        ]);

        $this->delete('auth_item', [
            'name' => 'Баннер Афиша'
        ]);

        $this->delete('auth_item', [
            'name' => 'Может заинтересовать афиша'
        ]);

        $this->delete('auth_item', [
            'name' => 'Верхнйи слайдер на странице афиш'
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171122_073745_create_insert_role_afisha cannot be reverted.\n";

        return false;
    }
    */
}
