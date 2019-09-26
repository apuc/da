<?php


namespace backend\modules\sima_land\controllers;

use backend\modules\sima_land\models\SearchGoods;
use Exception;
use Classes\Wrapper\IUrls;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

class GoodsController extends DefaultController
{

    public $category_id;

    /**
     * Lists all goods models.
     * @param int $page
     * @return mixed
     * @throws Exception
     */
    public function actionIndex($page = 1)
    {
        $this->currentPage = $page;

        try {
            list($searchModel , $dataProvider) = $this->preparePage($page , IUrls::Goods);
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

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
            'model' => $this->findById($id , IUrls::Goods) ,
        ]);
    }

    public function actionQuery($page = 1 , $category_id = null)
    {
        $this->currentPage = $page;
        $this->category_id = $category_id;

        $data = array(
            'category_id' => $category_id ,
            'page' => $page );

        $query = $this->runQuery(IUrls::Goods , $data);

        try {
            $resultData = $this->setCounts($page , $query);
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        if (empty($resultData)) {
            throw new NotFoundHttpException("Not Found!");
        }

        $searchModel = new SearchGoods();

        $dataProvider = new ArrayDataProvider([
            'key' => 'id' ,
            'allModels' => $resultData ,
            'pagination' => [
                'pageSize' => $this->pageSize ,
                'totalCount' => $this->totalPages ] ,
            'sort' => [
                'attributes' => array_keys($resultData[0])
            ] ,
        ]);
        return $this->render('index' , [
            'searchModel' => $searchModel ,
            'dataProvider' => $dataProvider
        ]);
    }
}
