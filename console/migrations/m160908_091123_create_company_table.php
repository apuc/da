<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company`.
 */
class m160908_091123_create_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),
            'address' => $this->string(255),
            'phone' => $this->string(255),
            'email' => $this->string(255),
            'photo' => $this->string(255),
            'dt_add' => $this->integer(11),
            'dt_update' => $this->integer(11),
            'descr' => $this->text(),
            'status' => $this->integer(1)->defaultValue(0),
            'slug' => $this->string(255),
            'lang_id' => $this->integer(11)->defaultValue(1),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company');
    }
}
