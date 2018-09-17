<?php

use yii\db\Migration;

/**
 * Class m180207_114111_add_currency_descriptions_in_key_value
 */
class m180207_114111_add_currency_descriptions_in_key_value extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('key_value', [
            'key' => 'currency_bottom_description',
            'value' => '<ol><li>Значение по курсам валют центрального банка Российской Федерации</li></ol>',
        ]);

        $this->insert('key_value', [
            'key' => 'currency_coin_bottom_description',
            'value' => '<ol><li>Значение по курсам криптовалют</li></ol>',
        ]);


        $this->insert('key_value', [
            'key' => 'currency_metal_bottom_description',
            'value' => '<ol><li>Учетные цены на драгоценные металлы центрального банка Российской Федерации</li></ol>',
        ]);


        $this->insert('key_value', [
            'key' => 'currency_gsm_bottom_description',
            'value' => '<ol><li>Стоимость фьючерсов на международном рынке</li></ol>',
        ]);

        $this->insert('key_value', [
            'key' => 'currency_converter_bottom_description',
            'value' => '<p>
                        Калькулятор курса валют – простой и удобный механизм, позволяющий выполнять моментальные
                        операции по переводу любых сумм из одних денежных единиц в другие. Конвертер валют онлайн
                        выполняет автоматический пересчет по курсу ЦБ РФ.
                        </p>',
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('key_value', [
            'key' => 'currency_bottom_description',
        ]);

        $this->delete('key_value', [
            'key' => 'currency_coin_bottom_description',
        ]);

        $this->delete('key_value', [
            'key' => 'currency_metal_bottom_description',
        ]);

        $this->delete('key_value', [
            'key' => 'currency_gsm_bottom_description',
        ]);

        $this->delete('key_value', [
            'key' => 'currency_converter_bottom_description',
        ]);

    }

}
