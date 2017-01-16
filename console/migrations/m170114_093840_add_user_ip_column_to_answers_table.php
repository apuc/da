<?php

use yii\db\Migration;

/**
 * Handles adding user_ip to table `answers`.
 */
class m170114_093840_add_user_ip_column_to_answers_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('answers', 'user_ip', $this->string(39));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('answers', 'user_ip');
    }
}
