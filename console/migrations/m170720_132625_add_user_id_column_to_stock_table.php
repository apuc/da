<?php

use yii\db\Migration;

/**
 * Handles adding user_id to table `stock`.
 */
class m170720_132625_add_user_id_column_to_stock_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('stock', 'user_id', $this->integer(11));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('stock', 'user_id');
    }
}
