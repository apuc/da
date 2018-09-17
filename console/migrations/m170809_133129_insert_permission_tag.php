<?php

use yii\db\Migration;

class m170809_133129_insert_permission_tag extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170809_133129_insert_permission_tag cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('auth_item', [
            'name' => 'Теги',
            'type' => 2,
            'created_at' => time(),
            'updated_at' => time()
        ]);
    }

    public function down()
    {
        $this->delete('auth_item', [
            'name' => 'Теги'
        ]);
    }

}
