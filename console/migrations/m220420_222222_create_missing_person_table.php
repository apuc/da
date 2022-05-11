<?php

use yii\db\Migration;


class m220420_222222_create_missing_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('missing_person', [
            'id' => $this->primaryKey(),
            'FIO' => $this->string(512),
            'date_of_birth' => $this->timestamp(),
            'city_id' => $this->integer()->unsigned()->notNull(),
        ]);

        $this->addForeignKey('missing_person_city_id', 'missing_person', 'city_id', 'geobase_city', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('forced_views');
    }
}
