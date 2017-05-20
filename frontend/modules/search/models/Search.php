<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 19.05.2017
 * Time: 13:41
 */

namespace frontend\modules\search\models;

use common\models\db\Company;
use common\models\db\Consulting;
use common\models\db\Faq;
use common\models\db\News;
use common\models\db\Poster;
use common\models\db\PostsConsulting;
use common\models\db\PostsDigest;
use yii\base\Model;

class Search extends Model
{
    public $request;

    public function getCountResults()
    {
        $results = [];

        $results['Новости'] = News::find()
            ->where(['like', 'title', $this->request])
            ->count();

        $results['Компании'] = Company::find()
            ->where(['like', 'name', $this->request])
            ->count();

        $results['Афиша'] = Poster::find()
            ->where(['like', 'title', $this->request])
            ->count();

        $results['Консалтинг'] = Consulting::find()
            ->where(['like', 'title', $this->request])
            ->count();

        $results['Вопрос / ответ'] = Faq::find()
            ->where(['like', 'question', $this->request])
            ->count();

        $results['Статьи'] = PostsConsulting::find()
            ->where(['like', 'title', $this->request])
            ->count();

        $results['Документы'] = PostsDigest::find()
            ->where(['like', 'title', $this->request])
            ->count();

        return $results;
    }

}