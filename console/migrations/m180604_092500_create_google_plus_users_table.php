<?php

use yii\db\Migration;

/**
 * Handles the creation of table `google_plus_users`.
 */
class m180604_092500_create_google_plus_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('google_plus_users', [
            'id' => $this->primaryKey(),
            'user_id' => $this->string(100)->defaultValue(null),
            'display_name' => $this->string(255)->defaultValue(null),
            'url' => $this->string(255)->defaultValue(null),
            'image' => $this->string(255)->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('google_plus_users');
    }
}
