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
                photo, 
                content AS descr, 
                dt_update, 
                CONCAT('/news/', slug) AS url 
            FROM news UNION
             
            SELECT 
                CONCAT('poster_', id) AS id, 
                title, 
                descr, 
                photo, 
                dt_update, 
                CONCAT('/poster/', slug) AS url  
            FROM poster UNION
             
            SELECT 
                CONCAT('company_', id) AS id, 
                name AS title, 
                descr, 
                photo, 
                dt_update, 
                CONCAT('/company/', slug) AS url  
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
