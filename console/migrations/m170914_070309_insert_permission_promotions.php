<?php

use yii\db\Migration;

class m170914_070309_insert_permission_promotions extends Migration
{
    public function up()
    {
        $this->insert('auth_item',[
            'name' => 'Объявления',
            'type'=> 2,
        ]);
    }

    public function down()
    {
        $this->delete('auth_item', [
            'name' => 'Объявления'
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170914_070309_insert_permission_promotions cannot be reverted.\n";

        return false;
    }
    */
}
