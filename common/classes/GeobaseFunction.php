<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 25.07.2017
 * Time: 9:26
 */

namespace common\classes;

use common\models\db\Company;
use common\models\db\GeobaseCity;
use common\models\db\GeobaseRegion;
use yii\helpers\ArrayHelper;

class GeobaseFunction
{
    /*
     * Получить массив городов и регионов вида:
     *
     * [Липецкая область] => Array
        (
            [2743] => Елец
            [1691] => Лебедянь
            [1499] => Липецк
        )
     */
    public static function getArrayCityRegion()
    {
        $city = GeobaseCity::find()
            ->select([
                '`geobase_city`.`name` as value',
                '`geobase_city`.`name` as  label',
                '`geobase_city`.`id` as id',
                '`geobase_region`.`name` as region_name',
                '`geobase_region`.`id` as region_id'
            ])
            ->leftJoin('`geobase_region`', '`geobase_region`.`id` = `geobase_city`.`region_id`')
            ->where(['`geobase_region`.`status`' => 1, '`geobase_city`.`status`' => 1])
            ->orderBy('`geobase_region`.`name`')
            ->addOrderBy('`geobase_city`.`name`')
            ->asArray()
            ->all();

        $i = 0;
        $data = [];
        foreach ($city as $item) {
            $data[$item['region_name']][$item['id']] = $item['value'];
        }

        return $data;
    }

    public static function getRegionName($id){
        $region = GeobaseRegion::find()->where(['id' => $id])->one();
        return $region->name;
    }

    public static function getRegionId($name){
        $region = GeobaseRegion::find()->where(['name' => $name])->one();
        return $region->id;
    }

    public static function getCityName($id){
        $city = GeobaseCity::find()->where(['id' => $id])->one();
        return $city->name;
    }


    public static function getListRegion()
    {
        $region = Company::find()->select('region_id')
            ->distinct()
            ->where(['!=', 'region_id', 0])
            ->all();
        $regionList = self::getListRegionName(ArrayHelper::getColumn($region, 'region_id'));
        return $regionList;
    }

    public static function getListRegionName($region)
    {
        $region = GeobaseRegion::find()->where(['id' => $region])->all();
        return $region;
    }
}