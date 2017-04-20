<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 19.04.2017
 * Time: 23:25
 */

namespace backend\modules\company_feedback\models;

use yii\db\ActiveRecord;

class CompanyFeedback extends \common\models\db\CompanyFeedback
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