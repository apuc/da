<?php

use yii\db\Migration;

/**
 * Class m171128_071531_insert_all_currency_to_key_value
 */
class m171128_071531_insert_all_currency_to_key_value extends Migration
{

    public function up()
    {
        $this->insert('key_value', [
            'key' => 'currency_title_all',
            'value' => 'Валютный рынок',
        ]);
        $this->insert('key_value', [
            'key' => 'currency_desc_all',
            'value' => 'Стоимость валют, криптовалют и драгметаллов',
        ]);
    }

    public function down()
    {
        $this->delete('key_value', [
            'key' => 'currency_title_all'
        ]);
        $this->delete('key_value', [
            'key' => 'currency_desc_all',
        ]);
    }
}
