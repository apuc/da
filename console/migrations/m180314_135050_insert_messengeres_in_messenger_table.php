<?php

use yii\db\Migration;

/**
 * Class m180314_135050_insert_messengeres_in_messenger_table
 */
class m180314_135050_insert_messengeres_in_messenger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('messenger', [
            'name' => 'Viber',
        ]);

        $this->insert('messenger', [
            'name' => 'WhatsApp',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('messenger', [
            'name' => 'WhatsApp',
        ]);

        $this->delete('messenger', [
            'name' => 'Viber',
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180314_135050_insert_messengeres_in_messenger_table cannot be reverted.\n";

        return false;
    }
    */
}
