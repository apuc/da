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

    public $newsCurrentId;
    public $useReg;

    public function run()
    {
        $params = \Yii::$app->params;

        $query = News::find()
            ->from('news FORCE INDEX(`views`)')
            ->andWhere(['>=', 'dt_public', time() - 2592000 * $params['countMonth']])
            ->andWhere(['>', 'views', $params['countView']])
            ->andWhere(['status' => 0, 'exclude_popular' => 0])
            ->andWhere(['!=', 'id', $this->newsCurrentId]);
        if($this->useReg != -1){
            $query->andWhere("(`region_id` IS NULL OR `region_id`=$this->useReg)");
        }
        $news = $query
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