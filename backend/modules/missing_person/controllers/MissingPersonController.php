<?php

namespace backend\modules\missing_person\controllers;

use backend\modules\missing_person\models\MissingPerson;
use backend\modules\missing_person\models\MissingPersonSearch;
use Yii;

class MissingPersonController extends \yii\web\Controller
{
    function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $searchModel = new MissingPersonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDelete($id)
    {
        MissingPerson::find($id)->delete();

        return $this->redirect(['index']);
    }
}