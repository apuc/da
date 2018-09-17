<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.12.2016
 * Time: 14:56
 */

namespace backend\modules\polls\models;


use common\models\db\Question;
use yii\db\ActiveRecord;

class Polls extends Question
{

    public function behaviors()
    {
        return [
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