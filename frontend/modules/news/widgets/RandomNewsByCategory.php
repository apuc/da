<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 15:33
 */

namespace frontend\modules\news\widgets;

use common\classes\Debug;
use common\models\db\News;
use Yii;
use yii\base\Widget;

class RandomNewsByCategory extends Widget
{
    public $categoryId;
    public $template = 'right';

    public function run()
    {
        $news = News::find()
            ->joinWith('categoryNewsRelations')
            ->where([
                '`category_news_relations`.`cat_id`' => $this->categoryId,
                'status' => 0,
            ])
            ->andWhere(['>=', 'dt_public', (string)(time() - 86400 * 7)])
            ->andWhere(['<=', 'dt_public', time()])
            ->orderBy('rand()')
            ->addOrderBy('dt_public DESC')
            ->limit(3)
            ->all();
        return $this->render('random-news-by-category/' . $this->template, [
            'news' => $news,
        ]);

    }

}