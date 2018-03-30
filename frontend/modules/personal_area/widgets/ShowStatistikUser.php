<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 28.06.2017
 * Time: 10:51
 */

namespace frontend\modules\personal_area\widgets;

use common\models\db\Company;
use common\models\db\CompanyFeedback;
use common\models\db\LikeProducts;
use common\models\db\Likes;
use common\models\db\NewsComments;
use common\models\db\PagesComments;
use common\models\db\Poster;
use common\models\db\Stock;
use common\models\db\StockComments;
use common\models\db\VkStreamComments;
use yii\base\Widget;

class ShowStatisticUser extends Widget
{
    public function run()
    {
        $newsCommentsCount = NewsComments::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $pagesCommentsCount = PagesComments::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $vkCommentsCount = VkStreamComments::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $feedbackCount = CompanyFeedback::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $stockCommentsCount = StockComments::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $allCommentsCount = $newsCommentsCount + $pagesCommentsCount + $vkCommentsCount + $feedbackCount + $stockCommentsCount;

        $likeCount = Likes::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $companyCount = Company::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $posterCount = Poster::find()->where(['user_id' => \Yii::$app->user->id])->count();
        $promotionsCount = Stock::find()->where(['user_id' => \Yii::$app->user->id])->andWhere(['in', 'status', [0, 1]])->count();
        $desireCount = LikeProducts::find()->where(['user_id' => \Yii::$app->user->id])->count();

        return $this->render('stistik-user',
            [
                'likes' => $likeCount,
                'comments' => $allCommentsCount,
                'company' => $companyCount,
                'poster' => $posterCount,
                'promotions' => $promotionsCount,
                'desireCount' => $desireCount,
            ]
        );
    }
}