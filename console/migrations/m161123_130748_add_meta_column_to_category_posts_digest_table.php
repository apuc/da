<?php

use yii\db\Migration;

/**
 * Handles adding meta to table `category_posts_digest`.
 */
class m161123_130748_add_meta_column_to_category_posts_digest_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category_posts_digest', 'meta_title', $this->string(255));
        $this->addColumn('category_posts_digest', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category_posts_digest', 'meta_title');
        $this->dropColumn('category_posts_digest', 'meta_descr');
    }
}
