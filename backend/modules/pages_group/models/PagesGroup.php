<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 06.05.2017
 * Time: 11:03
 */

namespace backend\modules\pages_group\models;

use yii\db\ActiveRecord;

class PagesGroup extends \common\models\db\PagesGroup
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