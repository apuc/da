<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_poster_relations`.
 */
class m161006_090828_create_category_poster_relations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_poster_relations', [
            'id' => $this->primaryKey(),
            'cat_id' => $this->integer(11),
            'poster_id' => $this->integer(11),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('category_poster_relations');
    }
}
