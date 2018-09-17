<?php

use yii\db\Migration;

/**
 * Class m180313_081018_add_service
 */
class m180313_081018_add_service extends Migration
{


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert('services',
            [
                'name' => 'Возможность добавлять товары',
                'price' => 0,
                'name_serv' => 'add_products',
                'val' => '1'
            ]);
    }

    public function down()
    {
        $this->delete('services', [
            'name_serv' => 'add_products',
        ]);
    }

}
