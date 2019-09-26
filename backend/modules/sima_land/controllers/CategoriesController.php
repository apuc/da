<?php


namespace backend\modules\sima_land\controllers;

use backend\modules\sima_land\models\SearchCategories;
use Exception;
use Classes\Wrapper\IUrls;
use yii\data\ArrayDataProvider;
use yii\web\NotFoundHttpException;

class CategoriesController extends DefaultController
{
    public $path;
    public $level;

    /**
     * Lists all categories models.
     * @param $page
     * @return mixed
     * @throws Exception
     */
    public function actionIndex($page = 1)
    {
        $this->currentPage = $page;
        list($searchModel , $dataProvider) = $this->preparePage($page , IUrls::Category);

        return $this->render('index' , [
            'searchModel' => $searchModel ,
            'dataProvider' => $dataProvider
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
            'model' => $this->findById($id , IUrls::Category) ,
        ]);
    }

    public function actionQuery($page = 1 , $path = null , $level = null)
    {
        $this->currentPage = $page;
        $this->level = $level;
        $this->path = $path;

        $data = array(
            'path' => $path ,
            'level' => $level,
            'page' => $page );

        $query = $this->runQuery(IUrls::Category , $data);

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
