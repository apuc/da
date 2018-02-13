<?php

use yii\db\Migration;

/**
 * Class m180212_131908_add_column_user_id_products_table
 */
class m180212_131908_add_column_user_id_products_table extends Migration
{



    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('products', 'user_id', $this->integer(11));
    }

    public function down()
    {
        $this->dropColumn('products', 'user_id');
    }

}
