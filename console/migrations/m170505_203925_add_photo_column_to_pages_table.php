<?php

use yii\db\Migration;

/**
 * Handles adding photo to table `pages`.
 */
class m170505_203925_add_photo_column_to_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('pages', 'photo', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('pages', 'photo');
    }
}
