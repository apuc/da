<?php

use yii\db\Migration;

/**
 * Class m171220_150224_update_ip_address_in_company_views_table
 */
class m171220_150224_update_ip_address_in_company_views_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->alterColumn('company_views', 'ip_address', $this->integer()->unsigned());
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->alterColumn('company_views', 'ip_address', $this->integer());
    }


}
