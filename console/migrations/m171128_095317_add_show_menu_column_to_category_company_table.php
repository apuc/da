<?php

use yii\db\Migration;

/**
 * Handles adding show_menu to table `category_company`.
 */
class m171128_095317_add_show_menu_column_to_category_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category_company', 'show_menu', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category_company', 'show_menu');
    }
}
