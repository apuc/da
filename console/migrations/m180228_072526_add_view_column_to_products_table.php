<?php

use yii\db\Migration;

/**
 * Handles adding view to table `products`.
 */
class m180228_072526_add_view_column_to_products_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('products', 'view', $this->integer(11)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('products', 'view');
    }
}
