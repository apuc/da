<?php

use yii\db\Migration;

/**
 * Class m171123_110342_insert_currency_keys_to_key_value
 */
class m171123_110342_insert_currency_keys_to_key_value extends Migration
{
    public function up()
    {
        $this->insert('key_value', [
            'key' => 'currency_title_page',
            'value' => 'Курсы валют',
        ]);
        $this->insert('key_value', [
            'key' => 'currency_desc_page',
            'value' => 'Курсы валют ЦБ РФ',
        ]);

        $this->insert('key_value', [
            'key' => 'currency_coin_title_page',
            'value' => 'Курсы криптовалют',
        ]);
        $this->insert('key_value', [
            'key' => 'currency_coin_desc_page',
            'value' => 'Курсы криптовалют',
        ]);

        $this->insert('key_value', [
            'key' => 'currency_metal_title_page',
            'value' => 'Курсы драгметаллов',
        ]);
        $this->insert('key_value', [
            'key' => 'currency_metal_desc_page',
            'value' => 'Курсы драгметаллов ЦБ РФ',
        ]);

        $this->insert('key_value', [
            'key' => 'currency_converter_title_page',
            'value' => 'Конвертер валют',
        ]);
        $this->insert('key_value', [
            'key' => 'currency_converter_desc_page',
            'value' => 'Конвертер валют ЦБ РФ',
        ]);
    }

    public function down()
    {
        $this->delete('key_value', [
            'key' => 'currency_title_page'
        ]);
        $this->delete('key_value', [
            'key' => 'currency_desc_page',
        ]);

        $this->delete('key_value', [
            'key' => 'currency_coin_title_page'
        ]);
        $this->delete('key_value', [
            'key' => 'currency_coin_desc_page',
        ]);

        $this->delete('key_value', [
            'key' => 'currency_metal_title_page'
        ]);
        $this->delete('key_value', [
            'key' => 'currency_metal_desc_page',
        ]);

        $this->delete('key_value', [
            'key' => 'currency_converter_title_page'
        ]);
        $this->delete('key_value', [
            'key' => 'currency_converter_desc_page',
        ]);
    }
}
