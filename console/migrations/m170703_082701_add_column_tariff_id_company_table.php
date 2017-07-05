<?php

use yii\db\Migration;

class m170703_082701_add_column_tariff_id_company_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('company', 'tariff_id', $this->integer(11)->defaultValue(0));
    }

    public function safeDown()
    {
        $this->dropColumn('company', 'tariff_id');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170703_082701_add_column_tariff_id_company_table cannot be reverted.\n";

        return false;
    }
    */
}
