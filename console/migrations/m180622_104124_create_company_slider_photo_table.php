<?php

use yii\db\Migration;

/**
 * Handles the creation of table `company_slider_photo`.
 */
class m180622_104124_create_company_slider_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('company_slider_photo', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(11),
            'photo' => $this->string(500)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('company_slider_photo');
    }
}
