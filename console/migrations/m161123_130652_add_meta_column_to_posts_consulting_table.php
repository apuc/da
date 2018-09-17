<?php

use yii\db\Migration;

/**
 * Handles adding meta to table `posts_consulting`.
 */
class m161123_130652_add_meta_column_to_posts_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('posts_consulting', 'meta_title', $this->string(255));
        $this->addColumn('posts_consulting', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('posts_consulting', 'meta_title');
        $this->dropColumn('posts_consulting', 'meta_descr');
    }
}
