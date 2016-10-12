<?php

use yii\db\Migration;

/**
 * Handles the creation for table `top_company`.
 */
class m160929_130307_create_top_company_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('top_company', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(11),
            'order' => $this->integer(2)->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('top_company');
    }
}
