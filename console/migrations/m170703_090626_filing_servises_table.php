<?php

use yii\db\Migration;

class m170703_090626_filing_servises_table extends Migration
{
    public function up()
    {
        $this->insert('services',
            [
                'name' => 'Количество символов - 250',
                'price' => 0,
                'name_serv' => 'count_text',
                'val' => '255'
            ]);
        $this->insert('services',
            [
                'name' => 'Количество символов - 1000',
                'price' => 20,
                'name_serv' => 'count_text',
                'val' => '1000'
            ]);
        $this->insert('services',
            [
                'name' => 'Количество символов - без ограничений',
                'price' => 20,
                'name_serv' => 'count_text',
                'val' => '-'
            ]);
        $this->insert('services',
            [
                'name' => 'Количество телефонов - 2',
                'price' => 0,
                'name_serv' => 'count_phone',
                'val' => '2'
            ]);
        $this->insert('services',
            [
                'name' => 'Количество телефонов - 5',
                'price' => 30,
                'name_serv' => 'count_phone',
                'val' => '5'
            ]);
        $this->insert('services',
            [
                'name' => 'Количество телефонов - без ограничений',
                'price' => 100,
                'name_serv' => 'count_phone',
                'val' => '-'
            ]);
        $this->insert('services',
            [
                'name' => 'Возможность добавить в контактную информацию сайт и группы',
                'price' => 100,
                'name_serv' => 'group_link',
                'val' => '1'
            ]);

        $this->insert('services',
            [
                'name' => 'Ограничения по фото компании - 5',
                'price' => 100,
                'name_serv' => 'count_photo',
                'val' => '5'
            ]);
        $this->insert('services',
            [
                'name' => 'Ограничения по фото компании - 20',
                'price' => 100,
                'name_serv' => 'count_photo',
                'val' => '20'
            ]);
        $this->insert('services',
            [
                'name' => 'Ограничения по фото компании - 100',
                'price' => 100,
                'name_serv' => 'count_photo',
                'val' => '100'
            ]);

        $this->insert('services',
            [
                'name' => 'Ограничения по акциям ( 1 )',
                'price' => 100,
                'name_serv' => 'count_stock',
                'val' => '1'
            ]);
        $this->insert('services',
            [
                'name' => 'Ограничения по акциям ( 5 )',
                'price' => 100,
                'name_serv' => 'count_stock',
                'val' => '5'
            ]);
        $this->insert('services',
            [
                'name' => 'Ограничения по акциям ( без ограничений )',
                'price' => 100,
                'name_serv' => 'count_stock',
                'val' => '-'
            ]);

        $this->insert('tariff',
            [
                'id' => 1,
                'name' => 'Начальный',
                'price' => 0,
                'published' => 1
            ]);
        $this->insert('tariff',
            [
                'id' => 2,
                'name' => 'Бизнес',
                'price' => 0,
                'published' => 1
            ]);
        $this->insert('tariff',
            [
                'id' => 3,
                'name' => 'Максимальный',
                'price' => 0,
                'published' => 1
            ]);
        $this->insert('tariff',
            [
                'id' => 4,
                'name' => 'Продвинутый',
                'price' => 0,
                'published' => 1
            ]);
    }

    public function down()
    {
        $this->delete('tariff');
        $this->delete('services');
    }

    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170703_090626_filing_servises_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.

    */
}
