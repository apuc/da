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
        $allTags = Tags::find()->all();
        $request = \Yii::$app->request->get();
        if (empty($request['id'])) {
            return $this->render('empty-tag', ['allTags' => $allTags]);
        }
        $searchModel = new TagSearch();
        $searchModel->tagId = $request['id'];

        $dataProvider = $searchModel->search();

        $randTags = $searchModel->randTags();

        if (empty(Tags::findOne(['id' => $request['id']]))) {
            return $this->render('empty-tag', ['allTags' => $allTags]);
        }

        return $this->render('tag-index', [
            //'searchModel' => $searchModel,
            'tag' => Tags::findOne(['id' => $request['id']])->tag,
            'dataProvider' => $dataProvider,
            'randTags' => $randTags,
            'allTags' => $allTags
        ]);

    }
}