<?php

use yii\db\Migration;

/**
 * Handles adding vip to table `company`.
 */
class m161010_112838_add_vip_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'vip', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'vip');
    }
}
