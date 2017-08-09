<?php

use yii\db\Migration;

class m170808_122003_create_table_tags_relation extends Migration
{
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170808_122003_create_table_tags_relation cannot be reverted.\n";

        return false;
    }*/


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('tags_relation', [
            'id' => $this->primaryKey(),
            'type' => $this->string(255),
            'post_id' => $this->integer(11),
            'tag_id' => $this->integer(11)
        ]);
    }

    public function down()
    {
        $this->dropTable('tags_relation');
    }

}
