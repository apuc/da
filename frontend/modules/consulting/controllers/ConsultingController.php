<?php

namespace frontend\modules\consulting\controllers;

use common\models\db\Consulting;

class ConsultingController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        return $this->render('index');
        $consulting = Consulting::find()->all();
        
        return $this->render('index',['consulting'=>$consulting]);
    }

}
