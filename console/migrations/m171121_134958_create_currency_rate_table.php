<?php

use yii\db\Migration;

/**
 * Handles the creation of table `currency_rate`.
 */
class m171121_134958_create_currency_rate_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('currency_rate', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'currency_from_id' => $this->integer(11)->notNull(),
            'currency_to_id' => $this->integer(11)->notNull(),
            'rate' => $this->double()->notNull(),
        ]);

        // creates index for columns `date`, `currency_from_id`, `currency_to_id`
        $this->createIndex(
            'idx-currency_rate-currency_date',
            'currency_rate',
            [
                'date',
                'currency_from_id',
                'currency_to_id',
            ],
            true
        );

        // add foreign key for table `currency`
        $this->addForeignKey(
            'fk-currency_rate-currency_from_id',
            'currency_rate',
            'currency_from_id',
            'currency',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        // add foreign key for table `currency`
        $this->addForeignKey(
            'fk-currency_rate-currency_to_id',
            'currency_rate',
            'currency_to_id',
            'currency',
            'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `currency`
        $this->dropForeignKey(
            'fk-currency_rate-currency_to_id',
            'currency_rate'
        );

        // drops foreign key for table `currency`
        $this->dropForeignKey(
            'fk-currency_rate-currency_from_id',
            'currency_rate'
        );

        // drops index for column `currency_id`
        $this->dropIndex(
            'idx-currency_rate-currency_date',
            'currency_rate'
        );

        $this->dropTable('currency_rate');
    }
}
