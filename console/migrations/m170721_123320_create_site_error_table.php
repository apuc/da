<?php

use yii\db\Migration;

/**
 * Handles the creation of table `site_error`.
 */
class m170721_123320_create_site_error_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('site_error', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'url' => $this->string(255)->notNull(),
            'msg' => $this->text(),
            'dt_add' => $this->integer()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('site_error');
    }
}
