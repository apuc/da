<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 07.12.17
 * Time: 12:27
 */

namespace frontend\modules\mainpage\widgets;

use common\classes\Debug;
use common\models\db\CategoryNewsRelations;
use Yii;
use yii\base\Widget;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

class ShowHotThemeNews extends Widget
{
    public $category = '6,7';
    public function run()
    {
        $db = new Connection(Yii::$app->db);
        $news = $db->createCommand(
            'SELECT 
                    DISTINCT `news`.`id` AS idNews,
                    `news`.`title` AS titleNews,
                    `news`.`dt_public`,
                    `news`.`slug` AS  slugNews,
                    `news`.`views`,
                    `news`.`photo` AS photoNews,
                    `news`.`content`,
                    `t3`.`title` AS titleCat,
                    `t3`.`slug` AS slugCat,
                    `t3`.`id` AS idCat,
                    `t3`.`meta_descr` AS metaDescrCat
                  FROM `news`
                  LEFT JOIN `category_news_relations` `t2`ON `t2`.`new_id` = `news`.`id`
                  LEFT JOIN `category_news` `t3` ON `t3`.`id` = `t2`.`cat_id`
                  WHERE `news`.`status` = 0 AND `news`.`dt_public` <= '. time() .' 
                    AND `t3`.`id` IN ('.$this->category.')
                  ORDER BY `news`.`dt_public` DESC 
                  LIMIT 25'
        )->queryAll();


        $newsAll = [];
        foreach ($news as $item){
            if(!empty($newsAll[$item['idCat']]) && count($newsAll[$item['idCat']]) == 5){ continue;}
            $newsAll[$item['idCat']][] = $item;

        }
        return $this->render('hot-theme',
            [
                'newsLeft' => $newsAll[$this->category[0]],
                'newsRight' => $newsAll[$this->category[2]],
            ]
        );
    }
}