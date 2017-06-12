<?php

use yii\db\Migration;

/**
 * Handles the creation of table `soc_available`.
 */
class m170609_072107_create_soc_available_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('soc_available', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'icon' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('soc_available');
    }
}
