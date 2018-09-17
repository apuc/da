<?php

use yii\db\Migration;

/**
 * Handles the creation of table `soc_company`.
 * Has foreign keys to the tables:
 *
 * - `company`
 * - `soc_available`
 */
class m170609_073954_create_soc_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('soc_company', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'link' => $this->string(255),
            'soc_type' => $this->integer(),
        ]);

        // creates index for column `comp_id`
        $this->createIndex(
            'idx-soc_company-comp_id',
            'soc_company',
            'company_id'
        );

        // add foreign key for table `company`
        $this->addForeignKey(
            'fk-soc_company-comp_id',
            'soc_company',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );

        // creates index for column `soc_type`
        $this->createIndex(
            'idx-soc_company-soc_type',
            'soc_company',
            'soc_type'
        );

        // add foreign key for table `soc_available`
        $this->addForeignKey(
            'fk-soc_company-soc_type',
            'soc_company',
            'soc_type',
            'soc_available',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `company`
        $this->dropForeignKey(
            'fk-soc_company-comp_id',
            'soc_company'
        );

        // drops index for column `comp_id`
        $this->dropIndex(
            'idx-soc_company-comp_id',
            'soc_company'
        );

        // drops foreign key for table `soc_available`
        $this->dropForeignKey(
            'fk-soc_company-soc_type',
            'soc_company'
        );

        // drops index for column `soc_type`
        $this->dropIndex(
            'idx-soc_company-soc_type',
            'soc_company'
        );

        $this->dropTable('soc_company');
    }
}
