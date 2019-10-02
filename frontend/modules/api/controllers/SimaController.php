<?php

namespace frontend\modules\api\controllers;

use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;
use common\classes\Debug;

class SimaController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCategory()
    {
        $data = array(
            'level'=>'1');

        $res = Wrapper::runFor(IUrls::Category)
            ->query($data)->getJson();

        //$res = json_encode($res);

        return $res;
    }

}
