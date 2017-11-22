<?php

use yii\db\Migration;

/**
 * Class m171110_122612_update_exchange_table
 */
class m171110_122612_update_exchange_table extends Migration
{

    public function up()
    {
        $this->dropColumn('{{%exchange}}', 'date');
        $this->addColumn('{{%exchange}}', 'date', $this->date()->notNull());

    }

    public function down()
    {
        $this->dropColumn('{{%exchange}}', 'date');
        $this->addColumn('{{%exchange}}', 'date', $this->integer(10)->notNull());
    }
}
