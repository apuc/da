<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency`.
 */
class m171121_134047_create_currency_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('currency', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255),
            'code' => $this->integer(11)->notNull(),
            'char_code' => $this->string(255),
            'nominal' => $this->integer(11)->defaultValue(1),
            'status' => $this->integer(1)->defaultValue(0),
            'type' => $this->integer(1),
        ]);

        $this->insert('currency', [
            'name' => 'Российский рубль',
            'code' => 810,
            'char_code' => 'RUB',
            'status' => 2,
            'type' => 1,
        ]);

        //USD
        $this->insert('currency', ['code' => 840, 'status' => 2, 'type' => 1]);
        //EUR
        $this->insert('currency', ['code' => 978, 'status' => 2, 'type' => 1]);
        //UAH
        $this->insert('currency', ['code' => 980, 'status' => 1, 'type' => 1]);
        //Au
        $this->insert('currency', ['code' => 1, 'status' => 1]);
        //Bitcoin
        $this->insert('currency', ['code' => 1182, 'status' => 2, 'type' => 2]);
        //Litecoin
        $this->insert('currency', ['code' => 3808, 'status' => 2, 'type' => 2]);
        //Etherium
        $this->insert('currency', ['code' => 7605, 'status' => 2, 'type' => 2]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('currency');
    }
}
