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

        $params = \Yii::$app->params;

        $news = News::find()
            ->where(['status' => 0, 'exclude_popular' => 0])
            ->andWhere(['>=', 'dt_public', time() - 2592000 * $params['countMonth']])
            ->andWhere(['!=', 'slug', $currentNewSlug])
            ->andWhere(['>', 'views', $params['countView']])
            ->orderBy('RAND()')
            ->addOrderBy('views ASC')
            ->limit(2)
            ->with('category')
            ->all();
//Debug::prn($news->createCommand()->rawSql);

        return $this->render('most_popular_news', [
            'news' => $news,
        ]);

    }

}