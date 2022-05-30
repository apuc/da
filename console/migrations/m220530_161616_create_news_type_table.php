<?php

class m220530_161616_create_news_type_table extends \yii\db\Migration
{
    public function up()
    {
        $this->createTable('news_type', [
            'id' => $this->primaryKey(),
            'label' => $this->string(32)->notNull()->unique()
        ]);
    }

    public function down()
    {
        $this->dropTable('news_type');
    }
}