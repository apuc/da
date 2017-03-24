<?php

use yii\db\Migration;

/**
 * Handles adding address to table `poster`.
 */
class m170324_084035_add_address_column_to_poster_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('poster', 'address', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('poster', 'address');
    }
}
