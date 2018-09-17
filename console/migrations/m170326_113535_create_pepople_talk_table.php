<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pepople_talk`.
 */
class m170326_113535_create_pepople_talk_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('people_talk', [
            'id' => $this->primaryKey(),
            'nickname' => $this->string(128)->notNull(),
            'title' => $this->string(255)->notNull(),
            'rating' => $this->integer()->defaultValue(0),
            'photo' => $this->string(255),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('people_talk');
    }
}
