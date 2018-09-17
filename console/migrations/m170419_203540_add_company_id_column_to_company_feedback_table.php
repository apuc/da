<?php

use yii\db\Migration;

/**
 * Handles adding company_id to table `company_feedback`.
 */
class m170419_203540_add_company_id_column_to_company_feedback_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company_feedback', 'company_id', $this->integer(11)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company_feedback', 'company_id');
    }
}
