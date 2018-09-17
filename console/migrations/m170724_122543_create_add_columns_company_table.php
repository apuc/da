<?php

use yii\db\Migration;

/**
 * Handles the creation of table `add_columns_company`.
 */
class m170724_122543_create_add_columns_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('company', 'region_id', $this->integer(11)->notNull());
        $this->addColumn('company', 'city_id', $this->integer(11)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('company', 'region_id');
        $this->dropColumn('company', 'city_id');
    }
}
