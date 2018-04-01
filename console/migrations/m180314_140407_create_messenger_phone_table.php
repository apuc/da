<?php

use yii\db\Migration;

/**
 * Handles the creation of table `messenger_phone`.
 */
class m180314_140407_create_messenger_phone_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('messenger_phone', [
            'messenger_id' => $this->integer(11)->notNull(),
            'phone_id' => $this->integer(11)->notNull(),
        ]);

        // creates index for column `messenger_id`
        $this->createIndex(
            'idx-messenger_phone-messenger_id',
            'messenger_phone',
            'messenger_id'
        );

        // add foreign key for table `messenger`
        $this->addForeignKey(
            'fk-messenger_phone-messenger_id',
            'messenger_phone',
            'messenger_id',
            'messenger',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        // creates index for column `phone_id`
        $this->createIndex(
            'idx-messenger_phone-phone_id',
            'messenger_phone',
            'phone_id'
        );

        // add foreign key for table `messenger`
        $this->addForeignKey(
            'fk-messenger_phone-phone_id',
            'messenger_phone',
            'phone_id',
            'phones',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `messenger`
        $this->dropForeignKey(
            'fk-messenger_phone-messenger_id',
            'messenger_phone'
        );

        // drops index for column `messenger_id`
        $this->dropIndex(
            'idx-messenger_phone-messenger_id',
            'messenger_phone'
        );

        // drops foreign key for table `messenger`
        $this->dropForeignKey(
            'fk-messenger_phone-phone_id',
            'messenger_phone'
        );

        // drops index for column `phone_id`
        $this->dropIndex(
            'idx-messenger_phone-phone_id',
            'messenger_phone'
        );

        $this->dropTable('messenger_phone');
    }
}
