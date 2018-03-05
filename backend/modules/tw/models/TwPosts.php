<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 23.02.2018
 * Time: 21:21
 */

namespace backend\modules\tw\models;

use yii\db\ActiveRecord;

class TwPosts extends \common\models\db\TwPosts
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_publish'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_publish'],
                ],
            ],
        ];
    }
}