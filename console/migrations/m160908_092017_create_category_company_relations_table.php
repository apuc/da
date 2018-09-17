<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_company_relations`.
 */
class m160908_092017_create_category_company_relations_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('category_company_relations', [
            'id' => $this->primaryKey(),
            'cat_id' => $this->integer(11),
            'company_id' => $this->integer(11),
        ]);

        $this->addForeignKey('category_c_relations_fk', 'category_company_relations', 'cat_id', 'category_company', 'id', 'RESTRICT', 'CASCADE');
        $this->addForeignKey('company_relations_fk', 'category_company_relations', 'company_id', 'company', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('category_c_relations_fk', 'category_company_relations');
        $this->dropForeignKey('company_relations_fk', 'category_company_relations');
        $this->dropTable('category_company_relations');
    }
}
