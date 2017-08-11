<?php

use yii\db\Migration;

class m170811_065249_create_table_phones extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170811_065249_create_table_phones cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('phones', [
            'id' => $this->primaryKey(),
            'phone' => $this->string(50)->defaultValue(''),
            'company_id' => $this->integer(11)->defaultValue(0),
        ]);
    }

    public function down()
    {
       $this->dropTable('phones');
    }

}
