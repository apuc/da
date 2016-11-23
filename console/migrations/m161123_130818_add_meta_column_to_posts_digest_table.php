<?php

use yii\db\Migration;

/**
 * Handles adding meta to table `posts_digest`.
 */
class m161123_130818_add_meta_column_to_posts_digest_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('posts_digest', 'meta_title', $this->string(255));
        $this->addColumn('posts_digest', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('posts_digest', 'meta_title');
        $this->dropColumn('posts_digest', 'meta_descr');
    }
}
