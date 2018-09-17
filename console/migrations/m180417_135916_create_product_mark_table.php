<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_mark`.
 */
class m180417_135916_create_product_mark_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_mark', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull(),
            'mark' => $this->integer(2)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('product_mark');
    }
}
