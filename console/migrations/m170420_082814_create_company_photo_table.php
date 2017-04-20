<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company_photo`.
 */
class m170420_082814_create_company_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company_photo', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(11)->notNull(),
            'photo' => $this->string(255)->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company_photo');
    }
}
