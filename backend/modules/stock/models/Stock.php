<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 18.04.2017
 * Time: 14:39
 */

namespace backend\modules\stock\models;

use yii\db\ActiveRecord;

class Stock extends \common\models\db\Stock
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