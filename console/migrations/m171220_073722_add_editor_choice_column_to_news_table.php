<?php

use yii\db\Migration;

/**
 * Handles adding editor_choice to table `news`.
 */
class m171220_073722_add_editor_choice_column_to_news_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('news','editor_choice', $this->integer(1)->defaultValue(0));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('news', 'editor_choice');
    }
}
