<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 20.10.2016
 * Time: 16:44
 */

namespace backend\modules\faq\models;

use yii\db\ActiveRecord;

class Faq extends \common\models\db\Faq {
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'question',
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