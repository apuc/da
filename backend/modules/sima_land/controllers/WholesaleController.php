<?php


namespace backend\modules\sima_land\controllers;

use backend\modules\sima_land\models\SearchCategories;
use backend\modules\sima_land\models\SearchGoods;
use Exception;
use Classes\Wrapper\IUrls;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

class WholesaleController extends DefaultController
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

        $query = $this->runQuery(IUrls::Wholesale , array( 'is_active' => 1 , 'page'=> $page));

        try {
            $resultData = $this->setCounts($page , $query);
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        if (empty($resultData)) {
            throw new NotFoundHttpException("Not Found!");
        }

        $searchModel = new SearchCategories();

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
