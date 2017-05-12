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

    public function run()
    {
        $news = News::find()
            ->joinWith('categoryNewsRelations')
            ->where([
                '`category_news_relations`.`cat_id`' => $this->categoryId,
                'status' => 0,
            ])
            /*->andWhere(['>=', 'dt_public', (string)(time() - 86400 * 14)])*/
            ->orderBy('rand()')
            ->limit(3)
            ->all();
        return $this->render("random_news_by_category", [
            'news' => $news,
        ]);

    }

}