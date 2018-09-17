<?php

use yii\db\Migration;

/**
 * Class m171226_072554_insert_guest_in_user_table
 */
class m171226_072554_insert_guest_in_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('{{%user}}', [
            'id' => -1,
            'username' => 'guest',
            'email' => 'guest@da.info',
            'password_hash' => '',
            'auth_key' => '',
            'created_at' => time(),
            'updated_at' => time()
        ]);
        $this->update('{{%user}}', ['id' => 0], ['id' => -1]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', [
            'username' => 'guest'
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171226_072554_insert_guest_in_user_table cannot be reverted.\n";

        return false;
    }
    */
}
