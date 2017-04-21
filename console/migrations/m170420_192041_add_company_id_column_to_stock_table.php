<?php

use yii\db\Migration;

/**
 * Handles adding company_id to table `stock`.
 */
class m170420_192041_add_company_id_column_to_stock_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('stock', 'company_id', $this->integer(11)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('stock', 'company_id');
    }
}
