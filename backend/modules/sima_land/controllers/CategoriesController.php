<?php


namespace backend\modules\sima_land\controllers;

use backend\modules\sima_land\models\SearchCategories;
use Classes\Wrapper\Wrapper;
use Exception;
use Classes\Wrapper\IUrls;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class CategoriesController extends DefaultController
{
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

    public function actionQuery($page = 1, $path = null, $level = null)
    {
        if($path == null && $level) {
            return $this->actionIndex($page);
        }
        else{

            $data = array(
                'path'=> $path,
                'level'=> $level);

            $query = Wrapper::runFor(IUrls::Category)
                ->query($data);

            $resultData = $this->setCounts($page , $query);

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
}
