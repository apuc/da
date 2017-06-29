<?php

use yii\db\Migration;
use yii\db\Schema;

class m170629_091028_add_columns_profile_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%profile}}', 'avatar', Schema::TYPE_STRING);
        $this->addColumn('{{%profile}}', 'avatar_little', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('{{%profile}}', 'avatar');
        $this->dropColumn('{{%profile}}', 'avatar_little');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
