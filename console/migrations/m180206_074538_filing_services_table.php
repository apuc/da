<?php

use yii\db\Migration;

/**
 * Class m180206_074538_filing_services_table
 */
class m180206_074538_filing_services_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert('services',
            [
                'name' => 'Количество категорий - 1',
                'price' => 0,
                'name_serv' => 'count_category',
                'val' => '1'
            ]);
        $this->insert('services',
            [
                'name' => 'Количество категорий - 3',
                'price' => 0,
                'name_serv' => 'count_category',
                'val' => '3'
            ]);
        $this->insert('services',
            [
                'name' => 'Количество категорий - 5',
                'price' => 0,
                'name_serv' => 'count_category',
                'val' => '5'
            ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete('services', [
            'name_serv' => 'count_category',
        ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180206_074538_filing_services_table cannot be reverted.\n";

        return false;
    }
    */
}
