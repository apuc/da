<?php

use yii\db\Migration;

/**
 * Handles the creation of table `inst_accounts`.
 */
class m180924_081204_create_inst_accounts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('inst_accounts', [
            'id' => $this->primaryKey(),
            'account_id' => $this->string(),
            'username' => $this->string(),
            'profile_img' => $this->string(),
            'iprofile_link' => $this->string(),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('inst_accounts');
    }
}
