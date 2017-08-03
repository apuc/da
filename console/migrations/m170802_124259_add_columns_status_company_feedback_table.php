<?php

use yii\db\Migration;

class m170802_124259_add_columns_status_company_feedback_table extends Migration
{
    public function up()
    {
        $this->addColumn('company_feedback', 'status', $this->integer(2)->defaultValue(0));
    }

    public function down()
    {
       $this->dropColumn('company_feedback', 'status');
    }

    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170802_124259_add_columns_status_company_feedback_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.

    */
}
