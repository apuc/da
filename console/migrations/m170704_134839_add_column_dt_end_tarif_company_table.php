<?php

use yii\db\Migration;

class m170704_134839_add_column_dt_end_tarif_company_table extends Migration
{

    public function up()
    {
        $this->addColumn('company', 'dt_end_tariff', $this->integer(11)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('company', 'dt_end_tariff');
    }

   /* public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170704_134839_add_column_dt_end_tarif_company_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170704_134839_add_column_dt_end_tarif_company_table cannot be reverted.\n";

        return false;
    }
    */
}
