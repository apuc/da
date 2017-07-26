<?php

use yii\db\Migration;

class m170726_072531_insert_rule_user extends Migration
{
    public function up()
    {
        $this->insert('auth_item',
            [
                'name' => 'ГЕО',
                'type' => 2,
            ]
        );
    }

    public function down()
    {
        $this->delete('auth_item',
            [
                'name' => 'ГЕО',
            ]
        );
    }
   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170726_072531_insert_rule_user cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.

    */
}
