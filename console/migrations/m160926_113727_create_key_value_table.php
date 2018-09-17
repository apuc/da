<?php

use yii\db\Migration;

/**
 * Handles the creation for table `key_value`.
 */
class m160926_113727_create_key_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('key_value', [
            'id' => $this->primaryKey(),
            'key' => $this->string(255),
            'value' => $this->text(),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('key_value');
    }
}
