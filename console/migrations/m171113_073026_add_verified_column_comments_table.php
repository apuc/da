<?php

use yii\db\Migration;

/**
 * Class m171113_073026_add_verified_column_comments_table
 */
class m171113_073026_add_verified_column_comments_table extends Migration
{
    /**
     * @inheritdoc
     */

    public function up()
    {
        $this->addColumn('comments', 'verified', $this->integer(2)->defaultValue(0));
    }

    public function down()
    {
        $this->dropColumn('comments', 'verified');
    }
}
