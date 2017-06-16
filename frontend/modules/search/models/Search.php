<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 19.05.2017
 * Time: 13:41
 */

namespace frontend\modules\search\models;

use common\classes\Debug;
use common\models\db\TblViewSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

class Search extends TblViewSearch
{
    const CONST_NEWS = 1;
    const CONST_POSTER = 2;
    const CONST_COMPANY = 3;

    const CONST_WEEK = 'week';
    const CONST_YEAR = 'year';
    const CONST_MONTH = 'month';
    const CONST_DAY = 'day';

    public $request;
    public $interval;
    public $type;

    public static function getTypes()
    {
        return [
            self::CONST_NEWS => 'Новости',
            self::CONST_POSTER => 'Афиша',
            self::CONST_COMPANY => 'Предприятия',
            self::CONST_YEAR => 'за год',
            self::CONST_WEEK => 'за неделю',
            self::CONST_MONTH => 'за месяц',
            self::CONST_DAY => 'за день',
        ];
    }

    public static function getTypeLabel($type, $default = null)
    {
        $types = static::getTypes();
        return isset($types[$type]) ? $types[$type] : $default;
    }


    public function search()
    {
        $query = TblViewSearch::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
                'pageSizeParam' => false,
            ],
        ]);

        $query->andFilterWhere(['LIKE', 'title', $this->request])
            ->orFilterWhere(['LIKE', 'descr', $this->request]);

        $query->andFilterWhere(['>=', 'dt_update', self::setInterval($this->interval)]);
        $query->andFilterWhere(['material_type' => $this->type]);

        $query->orderBy('dt_update DESC');
/*Debug::prn($query->createCommand()->rawSql);*/
        return $dataProvider;
    }

    static function setInterval($interval)
    {
        $array = [
            'week' => time() - 86400 * 7,
            'day' => time() - 86400,
            'year' => 31536000,
            'month' => 2592000,
        ];

        return $array[$interval];
    }

    public function getCountMaterials()
    {
        $query = TblViewSearch::find();
        $query->addSelect('material_type, COUNT(*) AS count');
        $query->andFilterWhere(['LIKE', 'title', $this->request])
            ->orFilterWhere(['LIKE', 'descr', $this->request]);

        $query->andFilterWhere(['>=', 'dt_update', self::setInterval($this->interval)]);

        $query->groupBy('material_type');

        $count = $query->createCommand()->queryAll();

        return ArrayHelper::map($count, 'material_type', 'count');
    }

    public function allCountSearch($countMaterials)
    {
        return array_sum($countMaterials);
    }
}