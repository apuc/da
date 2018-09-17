<?php

use yii\db\Migration;

/**
 * Handles adding sidebar to table `consulting`.
 */
class m170401_103940_add_sidebar_column_to_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('consulting', 'sidebar', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('consulting', 'sidebar');
    }
}
