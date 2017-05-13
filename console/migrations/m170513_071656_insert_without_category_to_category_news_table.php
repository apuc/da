<?php

use yii\db\Migration;

class m170513_071656_insert_without_category_to_category_news_table extends Migration
{
    public function up()
    {
        $this->insert('category_news', [
            'title' => 'Без категории',
            'dt_add' => time(),
            'dt_update' => time(),
            'slug' => 'bez-categorii',
            'lang_id' => 1,
        ]);
    }

    public function down()
    {
        $this->delete('category_news', ['title' => 'Без категории']);
    }
}
