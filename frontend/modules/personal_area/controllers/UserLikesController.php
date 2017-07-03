<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.07.2017
 * Time: 16:58
 */

namespace frontend\modules\personal_area\controllers;

use common\classes\Debug;
use common\models\db\Likes;
use frontend\modules\personal_area\models\UserLikesSearch;
use yii\base\Controller;

class UserLikesController extends Controller
{
    public $layout = 'personal_area';

    public function actionIndex()
    {
        $searchModel = new UserLikesSearch();
        $dataProvider = $searchModel->search(['user_id' => \Yii::$app->user->id]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}