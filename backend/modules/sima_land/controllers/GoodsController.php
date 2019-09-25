<?php


namespace backend\modules\sima_land\controllers;


use Exception;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;
use yii\web\NotFoundHttpException;

class GoodsController extends DefaultController
{

    /**
     * Lists all goods models.
     * @param int $page
     * @return mixed
     * @throws Exception
     */
    public function actionIndex($page = 1)
    {
        $this->currentPage = $page;

        list($searchModel , $dataProvider) = $this->preparePage($page , IUrls::Goods);

        return $this->render('index' , [
            'searchModel' => $searchModel ,
            'dataProvider' => $dataProvider ,
        ]);
    }

    /**
     * Displays a single categories model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view' , [
            'model' => $this->find($id, IUrls::Category) ,
        ]);
    }
}
