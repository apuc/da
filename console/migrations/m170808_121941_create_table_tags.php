<?php

use yii\db\Migration;

class m170808_121941_create_table_tags extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170808_121941_create_table_tags cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('tags',[
            'id' => $this->primaryKey(),
            'tag' => $this->string(255)
        ]);
    }

    public function down()
    {
        $this->dropTable('tags');
    }

}
