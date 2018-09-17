<?php

use yii\db\Migration;

/**
 * Class m180125_081311_insert_petroleum_keys_to_key_value
 */
class m180125_081311_insert_petroleum_keys_to_key_value extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('key_value', [
            'key' => 'currency_petroleum_title_page',
            'value' => 'Нефтяные фьючерсы',
        ]);
        $this->insert('key_value', [
            'key' => 'currency_petroleum_desc_page',
            'value' => 'Нефтяные фьючерсы',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('key_value', [
            'key' => 'currency_petroleum_title_page'
        ]);
        $this->delete('key_value', [
            'key' => 'currency_petroleum_desc_page',
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180125_081311_insert_petroleum_keys_to_key_value cannot be reverted.\n";

        return false;
    }
    */
}
