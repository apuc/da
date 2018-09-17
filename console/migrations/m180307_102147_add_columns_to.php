<?php

use yii\db\Migration;

/**
 * Class m180307_102147_add_columns_to
 */
class m180307_102147_add_columns_to extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('company', 'delivery', $this->text());
        $this->addColumn('company', 'payment', $this->text());
    }

    public function down()
    {
        $this->dropColumn('company', 'payment');
        $this->dropColumn('company', 'delivery');
    }

}
