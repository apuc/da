<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 28.06.2017
 * Time: 10:51
 */

namespace frontend\modules\personal_area\widgets;

use common\models\db\Comments;
use common\models\db\Company;
use common\models\db\CompanyFeedback;
use common\models\db\Likes;
use yii\base\Widget;

class ShowStatistikUser extends Widget
{
    public function run()
    {
        $likeCount = Likes::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $commentsCount = Comments::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $feedbackCount = CompanyFeedback::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $companyCount = Company::find()->where(['user_id' => \Yii::$app->user->id])->count();
        return $this->render('stistik-user',
            [
                'likes' => $likeCount,
                'comments' => $commentsCount,
                'feedback' => $feedbackCount,
                'company' => $companyCount,
            ]
        );
    }
}