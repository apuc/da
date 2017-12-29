<?php

use yii\db\Migration;

/**
 * Class m171229_073129_insert_dnr_page_key_value_table
 */
class m171229_073129_insert_dnr_page_key_value_table extends Migration
{


    public function up()
    {
        $this->insert('key_value', [
            'key' => 'dnr_title_page',
            'value' => 'ДНР',
        ]);

        $this->insert('key_value', [
            'key' => 'dnr_desc_page',
            'value' => 'DNR',
        ]);
    }

    public function down()
    {
        $this->delete('key_value', [
            'key' => 'dnr_title_page',
        ]);

        $this->delete('key_value', [
            'key' => 'dnr_desc_page',
        ]);
    }

}
