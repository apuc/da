<?php

use yii\db\Migration;

/**
 * Handles adding link to table `situation`.
 */
class m170506_104202_add_link_column_to_situation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('situation', 'link', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('situation', 'link');
    }
}
