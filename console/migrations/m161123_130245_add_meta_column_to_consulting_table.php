<?php

use yii\db\Migration;

/**
 * Handles adding meta to table `consulting`.
 */
class m161123_130245_add_meta_column_to_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('consulting', 'meta_title', $this->string(255));
        $this->addColumn('consulting', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('consulting', 'meta_title');
        $this->dropColumn('consulting', 'meta_descr');
    }
}
