<?php

use yii\db\Migration;

class m170726_075124_add_column_status_region_table extends Migration
{
    public function up()
    {
        $this->addColumn('geobase_region', 'status', $this->integer(2)->defaultValue(1));
    }

    public function down()
    {
        $this->dropColumn('geobase_region', 'status');
    }
    /*public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m170726_075124_add_column_status_region_table cannot be reverted.\n";

        return false;
    }*/

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170726_075124_add_column_status_region_table cannot be reverted.\n";

        return false;
    }
    */
}
