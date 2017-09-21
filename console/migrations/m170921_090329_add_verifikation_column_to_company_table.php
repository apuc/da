<?php

use yii\db\Migration;

/**
 * Handles adding verifikation to table `company`.
 */
class m170921_090329_add_verifikation_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'verifikation', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'verifikation');
    }
}
