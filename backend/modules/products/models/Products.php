<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 26.02.18
 * Time: 10:44
 */

namespace backend\modules\products\models;


class Products extends \common\models\db\Products
{
    const PRODUCT_PUBLISHED = 1;
    const PRODUCT_MODER = 0;
    const PRODUCT_DELETE = 3;


    public static function getTypes()
    {
        return [
            self::PRODUCT_PUBLISHED => 'Опубликован',
            self::PRODUCT_MODER => 'На модерации',
            self::PRODUCT_DELETE => 'Удален',
        ];
    }

    public static function getTypeLabel($type, $default = null)
    {
        $types = static::getTypes();
        return isset($types[$type]) ? $types[$type] : $default;
    }
}