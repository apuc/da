<?php

use yii\db\Migration;

/**
 * Handles the creation of table `services`.
 */
class m170703_080340_create_services_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('services', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'descr' => $this->text(1000),
            'price' => $this->integer(11)->notNull(),
            'name_serv' => $this->string(255),
            'val' => $this->string(255)
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('services');
    }
}
