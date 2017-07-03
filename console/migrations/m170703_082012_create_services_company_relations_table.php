<?php

use yii\db\Migration;

/**
 * Handles the creation of table `services_company_relations`.
 */
class m170703_082012_create_services_company_relations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('services_company_relations', [
            'services_id' => $this->integer(11),
            'company_id' => $this->integer(11),
        ]);

        $this->addForeignKey(
            'services_c_relations_fk',
            'services_company_relations', 'services_id',
            'services', 'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->addForeignKey(
            'company_s_relations_fk',
            'services_company_relations', 'company_id',
            'company', 'id',
            'RESTRICT',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropForeignKey('company_s_relations_fk', 'services_company_relations');
        $this->dropForeignKey('services_c_relations_fk', 'services_company_relations');

        $this->dropTable('services_company_relations');
    }
}
