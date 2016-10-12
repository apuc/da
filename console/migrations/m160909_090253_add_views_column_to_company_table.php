<?php

use yii\db\Migration;

/**
 * Handles adding views to table `company`.
 */
class m160909_090253_add_views_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'views', $this->integer(11)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'views');
    }
}
