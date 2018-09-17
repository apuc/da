<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.05.2017
 * Time: 22:31
 */

namespace backend\modules\subscribe\models;

use yii\db\ActiveRecord;

class Subscribe extends \common\models\db\Subscribe
{

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add'],
                ],
            ],
        ];
    }

}