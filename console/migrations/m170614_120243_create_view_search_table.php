<?php

use yii\db\Migration;

/**
 * Handles the creation of table `view_search`.
 */
class m170614_120243_create_view_search_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->db->createCommand("
            CREATE OR REPLACE VIEW tbl_view_search AS
            SELECT 
                CONCAT('news_', id) AS id, 
                title, 
                content AS descr,
                photo, 
                dt_update, 
                slug,
                CONCAT('/news/', slug) AS url,
                CONCAT(1) AS  material_type
            FROM news UNION
             
            SELECT 
                CONCAT('poster_', id) AS id, 
                title, 
                descr, 
                photo, 
                dt_update, 
                slug,
                CONCAT('/poster/', slug) AS url,
                CONCAT(2) AS  material_type 
            FROM poster UNION
             
            SELECT 
                CONCAT('company_', id) AS id, 
                name AS title, 
                descr, 
                photo, 
                dt_update, 
                slug,
                CONCAT('/company/', slug) AS url,
                CONCAT(3) AS  material_type
            FROM company
        ")->execute();
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->db->createCommand('DROP VIEW tbl_view_search')->query();
    }
}
