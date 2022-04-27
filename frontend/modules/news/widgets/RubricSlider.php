<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 15:33
 */

namespace frontend\modules\news\widgets;

use common\classes\Debug;
use common\models\db\CategoryNews;
use common\models\db\News;
use Yii;
use yii\base\Widget;
use yii\db\Connection;
use yii\helpers\ArrayHelper;

class RubricSlider extends Widget
{
    public $categoryId;

    public function run()
    {

        //$catsListId = ArrayHelper::map(CategoryNews::find()->all(), 'id', 'title');
        /*$catsListId = CategoryNews::find()->all();
        $news = [];
        $i = 0;
        foreach ($catsListId as $item){
            $news[$i]['news'] = News::find()
                ->joinWith('categoryNewsRelations')

                ->where(['`category_news_relations`.`cat_id`' => $item->id])
                ->andWhere(['<=', 'dt_public', time()])
                ->andWhere(['status' => 0])
                ->orderBy('dt_public DESC')
                ->limit(5)
                ->with('category')
                ->all();
            $news[$i]['cat'] = $item;
            $i++;
        }

        Debug::prn($news);
        die();*/

        /*foreach ($catsListId as $id => $title) {
            $news[$title] = News::find()
                ->joinWith('categoryNewsRelations')

                ->where(['`category_news_relations`.`cat_id`' => $id])
                ->andWhere(['<=', 'dt_public', time()])
                ->andWhere(['status' => 0])
                ->orderBy('dt_public DESC')
                ->limit(5)
                ->with('category')
                ->all();
        }*/

        //Debug::prn($news);

        $params = \Yii::$app->params;
        $t = time() - (2592000 * $params['countMonth']);
        $db = new Connection(Yii::$app->db);
        $news = $db->createCommand(
            'SELECT 
                    DISTINCT `news`.`id` AS idNews,
                    `news`.`title` AS titleNews,
                    `news`.`dt_public`,
                    `news`.`slug` AS  slugNews,
                    `news`.`views`,
                    `news`.`photo` AS photoNews,
                    `t3`.`title` AS titleCat,
                    `t3`.`slug` AS slugCat,
                    `t3`.`id` AS idCat,
                    `t3`.`meta_descr` AS metaDescrCat
                  FROM `news`
                  LEFT JOIN `category_news_relations` `t2`ON `t2`.`new_id` = `news`.`id`
                  LEFT JOIN `category_news` `t3` ON `t3`.`id` = `t2`.`cat_id`
                  WHERE `dt_public` > ' . $t . '  AND `news`.`status` = 0 AND `news`.`dt_public` <= '. time() .' 
                  ORDER BY `news`.`dt_public` DESC 
                  LIMIT 1000'
        )->queryAll();

        $newsAll = [];
        foreach ($news as $item){
            if(!empty($newsAll[$item['idcat']]) && count($newsAll[$item['idcat']]) == 5){ continue;}
            $newsAll[$item['idcat']][] = $item;

        }

       /* $news = News::find()
            ->joinWith('category_news_relations')
            ->joinWith('category_news')
            ->andWhere(['<=', '`news`.`dt_public`', time()])
            ->andWhere(['`news`.`status`' => 0])
            ->groupBy('`news`.`id`')
            ->all();*/


            /*SELECT * FROM `news`
LEFT JOIN `category_news_relations` `t2`ON `t2`.`new_id` = `news`.`id`
LEFT JOIN `category_news` `t3` ON `t3`.`id` = `t2`.`cat_id`
WHERE `news`.`status` = 0
GROUP BY news.id*/

            ksort($newsAll);
            //reset($newsAll);
            /*Debug::prn($newsAll);
            die();*/

        return $this->render('rubric_slider', [
            'newsArray' => $newsAll,
        ]);

    }

}