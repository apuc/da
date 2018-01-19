<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 19.01.18
 * Time: 12:32
 */

namespace backend\modules\products\models;

class ProductFields extends \common\models\db\ProductFields
{
    public function behaviors()
    {
        return [
            'name' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'label',
                'out_attribute' => 'name',
                'translit' => true
            ],
        ];
    }
}