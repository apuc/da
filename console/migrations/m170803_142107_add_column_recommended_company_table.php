<?php

use yii\db\Migration;

class m170803_142107_add_column_recommended_company_table extends Migration
{

    public function up()
    {
        $this->addColumn('company', 'recommended', $this->integer(2)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('company', 'recommended');
    }

    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170803_142107_add_column_recommended_company_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170803_142107_add_column_recommended_company_table cannot be reverted.\n";

        return false;
    }
    */
}
