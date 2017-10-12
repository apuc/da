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

        $catsListId = ArrayHelper::map(CategoryNews::find()->all(), 'id', 'title');
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

        foreach ($catsListId as $id => $title) {
            $news[$title] = News::find()
                ->joinWith('categoryNewsRelations')

                ->where(['`category_news_relations`.`cat_id`' => $id])
                ->andWhere(['<=', 'dt_public', time()])
                ->andWhere(['status' => 0])
                ->orderBy('dt_public DESC')
                ->limit(5)
                ->with('category')
                ->all();
        }

        return $this->render('rubric_slider', [
            'newsArray' => $news,
        ]);

    }

}