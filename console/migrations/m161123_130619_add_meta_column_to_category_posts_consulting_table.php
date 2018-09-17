<?php

use yii\db\Migration;

/**
 * Handles adding meta to table `category_posts_consulting`.
 */
class m161123_130619_add_meta_column_to_category_posts_consulting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('category_posts_consulting', 'meta_title', $this->string(255));
        $this->addColumn('category_posts_consulting', 'meta_descr', $this->string(255));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('category_posts_consulting', 'meta_title');
        $this->dropColumn('category_posts_consulting', 'meta_descr');
    }
}
