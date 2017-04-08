<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 06.10.2016
 * Time: 12:47
 */

namespace backend\modules\poster\models;


use yii\db\ActiveRecord;

class Poster extends \common\models\db\Poster
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