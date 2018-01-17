<?php

use yii\db\Migration;

/**
 * Handles the creation of table `main_premiere`.
 */
class m171211_073250_create_main_premiere_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('main_premiere', [
            'id' => $this->primaryKey(),
            //'title' => $this->string(255)->notNull(),
            'description' => $this->string(255)->notNull(),
            'region_id' => $this->integer(11)->defaultValue(0),
            'photo' => $this->text(),
            'afisha_id' => $this->integer(11)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('main_premiere');
    }
}
