<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tariff_services_relations`.
 */
class m170703_081118_create_tariff_services_relations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('tariff_services_relations', [
            'tariff_id' => $this->integer(11),
            'services_id' => $this->integer(11)
        ]);

        $this->addForeignKey(
            'tariff_s_relations_fk',
            'tariff_services_relations', 'tariff_id',
            'tariff', 'id',
            'RESTRICT',
            'CASCADE'
        );
        $this->addForeignKey(
            'services_t_relations_fk',
            'tariff_services_relations', 'services_id',
            'services', 'id',
            'RESTRICT',
            'CASCADE'
        );

    }

    /**
     * @inheritdoc
     */
    public function down()
    {

        $this->dropForeignKey('services_t_relations_fk', 'tariff_services_relations');
        $this->dropForeignKey('tariff_s_relations_fk', 'tariff_services_relations');

        $this->dropTable('tariff_services_relations');
    }
}
