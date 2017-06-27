<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 22.06.2017
 * Time: 16:19
 */

namespace backend\modules\comments\models;

class Comments extends \common\models\db\Comments
{
    public static function getCountNotModerComments()
    {
        return \common\models\db\Comments::find()->where(['published' => 0])->count();
    }
}