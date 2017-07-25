<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 25.07.2017
 * Time: 9:26
 */

namespace common\classes;

use common\models\db\GeobaseCity;

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
}