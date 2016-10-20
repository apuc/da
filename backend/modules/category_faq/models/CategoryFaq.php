<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 20.10.2016
 * Time: 14:45
 */

namespace backend\modules\category_faq\models;


use yii\db\ActiveRecord;

class CategoryFaq extends \common\models\db\CategoryFaq{
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