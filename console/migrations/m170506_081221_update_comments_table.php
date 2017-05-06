<?php

use yii\db\Migration;

class m170506_081221_update_comments_table extends Migration
{
    public function up()
    {
        $this->addColumn('comments', 'parent_id', $this->integer(11)->defaultValue(0));
        $this->addColumn('comments', 'moder_checked', $this->integer(1)->defaultValue(0));

        //$this->addForeignKey('fk-comments-parent_id', 'comments', 'parent_id', 'comments', 'id', 'SET NULL');
    }

    public function down()
    {
        $this->dropColumn('comments', 'parent_id');
        $this->dropColumn('comments', 'moder_checked');
    }

}
