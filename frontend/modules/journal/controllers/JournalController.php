<?php

namespace frontend\modules\journal\controllers;

use common\classes\Debug;
use common\models\db\Journal;
use frontend\controllers\MainWebController;
use yii\web\Controller;

class JournalController extends MainWebController
{
    function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $journals = Journal::find()
            ->where(['status' => 1])
            ->orderBy('dt_add DESC')
            ->all();
        return $this->render('index',
        [
            'journals' => $journals
        ]);
    }

    public function actionView($slug)
    {
        $model = Journal::find()
            ->where(['slug' => $slug, 'status' => 1])
            ->one();
        $model->views += 1;
        $model->save();
        return $this->render('view',
            [
                'model' => $model
            ]);
    }

}
