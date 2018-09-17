<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 05.05.2017
 * Time: 23:16
 */

namespace backend\modules\pages\models;

use yii\db\ActiveRecord;

class Pages extends \common\models\db\Pages
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