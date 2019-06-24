<?php

use yii\db\Migration;

/**
 * Class m190606_070333_update_key_value
 */
class m190606_070333_update_key_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('key_value',['key' => 'all_category_page_meta_title',
            'value' => 'Все категории',
            'dt_add' => time(),
            'dt_update' => time() ]);

        $this->insert('key_value',['key' => 'all_category_page_meta_descr',
            'value' => 'Все категории',
            'dt_add' => time(),
            'dt_update' => time() ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('key_value', ['key' => 'all_category_page_meta_title']);
        $this->delete('key_value', ['key' => 'all_category_page_meta_descr']);
    }

}
