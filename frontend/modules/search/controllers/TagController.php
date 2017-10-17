<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 03.10.2017
 * Time: 13:17
 */

namespace frontend\modules\search\controllers;

use common\classes\Debug;
use common\models\db\Tags;
use frontend\modules\search\models\TagSearch;
use yii\web\Controller;

class TagController extends Controller
{
    public function actionIndex()
    {
        $request = \Yii::$app->request->get();


        $searchModel = new TagSearch();
        $searchModel->tagId = $request['id'];

        $dataProvider = $searchModel->search();

        $randTags = $searchModel->randTags();


        return $this->render('tag-index', [
            //'searchModel' => $searchModel,
            'tag' => Tags::find()->where(['id' => $request['id']])->one()->tag,
            'dataProvider' => $dataProvider,
            'randTags' => $randTags,
        ]);

    }
}