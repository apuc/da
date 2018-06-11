<?php

namespace frontend\modules\journal\controllers;

use common\classes\Debug;
use common\models\db\Journal;
use yii\filters\VerbFilter;
use yii\web\Controller;

class JournalController extends Controller
{


    public function actionIndex()
    {
        $journals = Journal::find()->all();
        //Debug::dd($journals);
        return $this->render('index',
        [
            'journals' => $journals
        ]);
    }

    public function actionView($slug)
    {
        $model = Journal::find()->where(['slug' => $slug])->one();
        return $this->render('view',
            [
                'model' => $model
            ]);
    }

}
