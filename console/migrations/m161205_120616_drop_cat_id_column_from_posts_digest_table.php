<?php

use yii\db\Migration;

/**
 * Handles dropping cat_id from table `posts_digest`.
 */
class m161205_120616_drop_cat_id_column_from_posts_digest_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->dropColumn('posts_digest', 'cat_id');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->addColumn('posts_digest', 'cat_id', $this->integer(11));
    }
}
