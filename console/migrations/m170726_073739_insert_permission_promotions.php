<?php

use yii\db\Migration;

class m170726_073739_insert_permission_promotions extends Migration
{/*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170726_073739_insert_permission_promotions cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('auth_item',[
                'name' => 'Акции',
                'type'=> 2,
            ]);
    }

    public function down()
    {
       $this->delete('auth_item', [
           'name' => 'Акции'
       ]);
    }

}
