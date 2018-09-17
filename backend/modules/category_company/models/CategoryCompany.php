<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 12:58
 */

namespace backend\modules\category_company\models;


use yii\db\ActiveRecord;

class CategoryCompany extends \common\models\db\CategoryCompany
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
        ];
    }
}