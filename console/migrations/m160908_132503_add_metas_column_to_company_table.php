<?php

use yii\db\Migration;

/**
 * Handles adding metas to table `company`.
 */
class m160908_132503_add_metas_column_to_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'meta_title', $this->string(255));
        $this->addColumn('company', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'meta_title');
        $this->dropColumn('company', 'meta_descr');
    }
}
