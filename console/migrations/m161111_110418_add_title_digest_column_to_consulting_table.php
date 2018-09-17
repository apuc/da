<?php

use yii\db\Migration;

/**
 * Handles adding title_digest to table `consulting`.
 */
class m161111_110418_add_title_digest_column_to_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('consulting', 'title_digest', $this->string(255)->notNull());
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('consulting', 'title_digest');
    }
}
