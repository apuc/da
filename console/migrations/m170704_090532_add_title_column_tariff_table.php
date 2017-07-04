<?php

use yii\db\Migration;

class m170704_090532_add_title_column_tariff_table extends Migration
{

    public function up()
    {
        $this->addColumn('tariff', 'title', $this->string(255)->notNull());
    }

    public function down()
    {
        $this->dropColumn('tariff', 'title');
    }

   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170704_090532_add_title_column_tariff_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.

    */
}
