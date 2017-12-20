<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company_views`.
 * Has foreign keys to the tables:
 *
 * - `user`
 * - `company`
 */
class m171219_123813_create_company_views_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('company_views', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'company_id' => $this->integer(),
            'date' => $this->datetime(),
            'ip_address' => $this->integer(),
            'count' => $this->integer()->defaultValue(1),
        ]);

        // creates index for column 3 field
        $this->createIndex(
            'idx-company_views-user_id-company_id-ip_address',
            'company_views',
            [
                'user_id',
                'company_id',
                'ip_address',
            ],
            true
        );
        // creates index for column `user_id`
        $this->createIndex(
            'idx-company_views-user_id',
            'company_views',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-company_views-user_id',
            'company_views',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // creates index for column `company_id`
        $this->createIndex(
            'idx-company_views-company_id',
            'company_views',
            'company_id'
        );

        // add foreign key for table `company`
        $this->addForeignKey(
            'fk-company_views-company_id',
            'company_views',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-company_views-user_id',
            'company_views'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-company_views-user_id',
            'company_views'
        );

        // drops foreign key for table `company`
        $this->dropForeignKey(
            'fk-company_views-company_id',
            'company_views'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-company_views-company_id',
            'company_views'
        );

        // drops index for column `company_id`
        $this->dropIndex(
            'idx-company_views-user_id-company_id-ip_address',
            'company_views'
        );

        $this->dropTable('company_views');
    }
}
