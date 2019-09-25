<?php


namespace backend\modules\sima_land\controllers;

use Exception;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use backend\modules\sima_land\models\SearchCategories;
use Classes\Wrapper\Wrapper;
use Classes\Wrapper\IUrls;
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

    public function actionQuery()
    {
        $model = new SearchCategories();

        return $this->render('query', [
            'model' => $model,
        ]);
    }
}
