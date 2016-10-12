<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 16:58
 */

namespace frontend\modules\news\widgets;


use backend\modules\news\models\News;
use common\models\db\Lang;
use yii\base\Widget;
use yii\data\Pagination;
use yii\data\SqlDataProvider;

class AllNewsWidget extends Widget
{

    public function run()
    {
        $query = News::find()
            ->where(['lang_id'=>Lang::getCurrent()['id'], 'status'=>0])
            ->orderBy('id DESC');

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 4]);
        $pages->pageSizeParam = false;

        $news = $query->offset($pages->offset);

        $dataProvider = new SqlDataProvider([
            'sql' => $news->createCommand()->rawSql,
            'params' => [':status' => 3],
            'totalCount' => (int)$countQuery->count(),
            'pagination' => [
                // количество пунктов на странице
                'pageSize' => 4,
            ]
        ]);

        return $this->render('all_news',[
            'news' => $news,
            'pages' => $pages,
            'dataProvider' => $dataProvider,
        ]);
    }

}