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

        $this->insert('tariff',
            [
                'name' => 'Бесплатный тариф',
                'price' => 0,
                'published' => 1
            ]);
    }

    public function down()
    {
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
