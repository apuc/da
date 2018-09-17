<?php

use yii\db\Migration;

/**
 * Class m180402_133112_add_type_filed
 */
class m180402_133112_add_type_filed extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('product_fields_type', [
            'type' => 'checkboxList',
        ]);
    }

    public function down()
    {
        $this->delete('product_fields_type', [
            'type' => 'checkboxList',
        ]);
    }

}
