<?php

use yii\db\Migration;

class m170726_081253_add_column_status_city_table extends Migration
{
    public function up()
    {
        $this->addColumn('geobase_city', 'status', $this->integer(2)->defaultValue(1));
    }

    public function down()
    {
        $this->dropColumn('geobase_city', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170726_081253_add_column_status_city_table cannot be reverted.\n";

        return false;
    }
    */
}
