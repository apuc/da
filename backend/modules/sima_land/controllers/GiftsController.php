<?php


namespace backend\modules\sima_land\controllers;


use Classes\Wrapper\IUrls;
use yii\web\NotFoundHttpException;

class GiftsController extends DefaultController
{
    /**
     * Renders the index view for the module
     * @param $page
     * @return string
     * @throws Exception
     * @throws NotFoundHttpException
     */
    public function actionIndex($page = 1)
    {
        $this->currentPage = $page;

        list($searchModel , $dataProvider) = $this->createData($page ,
            $this->runQuery(IUrls::Gift , array( 'is_active' => 1 , 'page' => $page )));

        return $this->render('index' , [
            'searchModel' => $searchModel ,
            'dataProvider' => $dataProvider
        ]);
    }
}
