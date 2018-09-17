<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_posts_digest_relations`.
 */
class m161205_113821_create_category_posts_digest_relations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_posts_digest_relations', [
            'id' => $this->primaryKey(),
            'cat_id' => $this->integer(11),
            'posts_digest_id' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_posts_digest_relations');
    }
}
