<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 21.10.2016
 * Time: 11:44
 */

namespace backend\modules\consulting\models;

use yii\db\ActiveRecord;

class Consulting  extends \common\models\db\Consulting{
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