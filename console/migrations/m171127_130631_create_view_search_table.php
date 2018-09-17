<?php

use yii\db\Migration;

/**
 * Handles the creation of table `view_search`.
 */
class m171127_130631_create_view_search_table extends Migration
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
            FROM news WHERE status=0 UNION
             
            SELECT 
                CONCAT('poster_', id) AS id, 
                title, 
                descr, 
                photo, 
                dt_update, 
                slug,
                CONCAT('/poster/', slug) AS url,
                CONCAT(2) AS  material_type 
            FROM poster WHERE status=0 UNION
             
            SELECT 
                CONCAT('company_', id) AS id, 
                name AS title, 
                descr, 
                photo, 
                dt_update, 
                slug,
                CONCAT('/company/', slug) AS url,
                CONCAT(3) AS  material_type
            FROM company WHERE status=0 UNION
            
            SELECT 
                CONCAT('stream_', id) AS id, 
                title, 
                text AS descr,
                CONCAT(NULL) AS photo, 
                dt_add AS dt_update, 
                slug,
                CONCAT('/stream/', slug) AS url,
                CONCAT(4) AS  material_type
            FROM vk_stream WHERE status=1 UNION
            
            SELECT 
                CONCAT('consulting_', id) AS id, 
                title, 
                content AS descr, 
                photo, 
                dt_update, 
                slug,
                CONCAT('/post/', slug) AS url,
                CONCAT(5) AS  material_type
            FROM posts_consulting UNION
            
            SELECT 
                CONCAT('consulting_', id) AS id, 
                title, 
                content AS descr, 
                photo, 
                dt_update, 
                slug,
                CONCAT('/document/', slug) AS url,
                CONCAT(6) AS  material_type
            FROM posts_digest
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
