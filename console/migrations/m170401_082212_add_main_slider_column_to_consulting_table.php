<?php

use yii\db\Migration;

/**
 * Handles adding main_slider to table `consulting`.
 */
class m170401_082212_add_main_slider_column_to_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('consulting', 'main_slider', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('consulting', 'main_slider');
    }
}
