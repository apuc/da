<?php


namespace frontend\modules\api\controllers;


use common\models\db\CategoryNews;
use common\models\db\News;
use Yii;
use yii\base\Controller;

class NewsController extends Controller
{
    /**
     * @return false|string
     */
    public function actionGetNews()
    {
        $news_id = Yii::$app->request->get('news_id');
        $category_id = Yii::$app->request->get('category_id');
        $limit = Yii::$app->request->get('limit');
        $offset = Yii::$app->request->get('offset');

        $query = News::find();

        if($news_id) {
            $query->where(['id' => $news_id]);
        } else {
            ($category_id) ? $query->leftJoin('category_news_relations', '`category_news_relations`.`new_id` = `news`.`id`')
                ->where(['category_news_relations.cat_id' => $category_id]) : '';
            ($limit) ? $query->limit($limit) : '';
            ($offset) ? $query->offset($offset) : '';
        }

        $news = $query->asArray()->all();

        if (!empty($news)) {
            return json_encode($news);
        } else {
            return json_encode('News not found');
        }
    }

    /**
     * @return false|string
     */
    public function actionGetNewsCategories()
    {
        $categories = CategoryNews::find()->all();

        return json_encode($categories);
    }
}