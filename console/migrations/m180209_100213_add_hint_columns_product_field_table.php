<?php

use yii\db\Migration;

/**
 * Class m180209_100213_add_hint_columns_product_field_table
 */
class m180209_100213_add_hint_columns_product_field_table extends Migration
{

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('product_fields', 'hint', $this->string(255)->notNull());
    }

    public function down()
    {
        $this->dropColumn('product_fields', 'hint');
    }

}
