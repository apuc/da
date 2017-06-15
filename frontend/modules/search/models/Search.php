<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 19.05.2017
 * Time: 13:41
 */

namespace frontend\modules\search\models;

use common\classes\Debug;
use common\models\db\Company;
use common\models\db\Consulting;
use common\models\db\Faq;
use common\models\db\News;
use common\models\db\Poster;
use common\models\db\PostsConsulting;
use common\models\db\PostsDigest;
use common\models\db\TblViewSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class Search extends TblViewSearch
{
    const CONST_NEWS = 1;
    const CONST_POSTER = 2;
    const CONST_COMPANY = 3;

    public $request;
    public $interval = 'week';

    public static function getTypes()
    {
        return [
            self::CONST_NEWS => 'Новости',
            self::CONST_POSTER => 'Афиша',
            self::CONST_COMPANY => 'Предприятия',
        ];
    }

    public static function getTypeLabel($type, $default = null)
    {
        $types = static::getTypes();
        return isset($types[$type]) ? $types[$type] : $default;
    }


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


    public function search()
    {
        Debug::prn(Url::home(true));
        $query = TblViewSearch::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
                'pageSizeParam' => false,
            ],
        ]);


        if($this->interval == 'week'){
            $interval = time() - 86400 *7;
        }
/*Debug::prn(date('d.m.Y',1497420149));*/


        $query->andFilterWhere(['LIKE', 'title', $this->request])
            ->orFilterWhere(['LIKE', 'descr', $this->request]);

        $query->andFilterWhere(['>=', 'dt_update', $interval]);


        $query->orderBy('dt_update DESC');
Debug::prn($query->createCommand()->rawSql);
        return $dataProvider;
    }


}