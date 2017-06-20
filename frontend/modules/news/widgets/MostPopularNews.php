<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 16:58
 */

namespace frontend\modules\news\widgets;

use backend\modules\news\models\News;
use common\classes\Debug;
use common\models\db\Lang;
use Yii;
use yii\base\Widget;
use yii\data\Pagination;
use yii\data\SqlDataProvider;

class MostPopularNews extends Widget
{

    public function run()
    {
        $currentNewSlug = Yii::$app->request->get()['slug'];

        $news = News::find()
            ->where(['status' => 0])
            /*->andWhere(['>=', 'dt_public', time() - (86400 * 14)])*/
            ->andWhere(['!=', 'slug', $currentNewSlug])
            ->orderBy('views DESC')
            ->limit(2)
            ->with('category')
            ->all();

        return $this->render('most_popular_news', [
            'news' => $news,
        ]);

    }

}