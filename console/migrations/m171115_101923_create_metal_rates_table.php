<?php

use yii\db\Migration;

/**
 * Handles the creation of table `metal_rates`.
 * Has foreign keys to the tables:
 *
 * - `metal`
 */
class m171115_101923_create_metal_rates_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('metal_rates', [
            'id' => $this->primaryKey(),
            'metal_id' => $this->integer(),
            'date' => $this->date(),
            'price' => $this->double(),
        ]);

        // creates index for column `metal_id`
        $this->createIndex(
            'idx-metal_rates-metal_id',
            'metal_rates',
            'metal_id'
        );

        // add foreign key for table `metal`
        $this->addForeignKey(
            'fk-metal_rates-metal_id',
            'metal_rates',
            'metal_id',
            'metal',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `metal`
        $this->dropForeignKey(
            'fk-metal_rates-metal_id',
            'metal_rates'
        );

        // drops index for column `metal_id`
        $this->dropIndex(
            'idx-metal_rates-metal_id',
            'metal_rates'
        );

        $this->dropTable('metal_rates');
    }
}
