<?php

use yii\db\Migration;

/**
 * Handles adding user to table `company`.
 */
class m160909_141410_add_user_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'user_id', $this->integer(11)->defaultValue(1));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'user_id');
    }
}
