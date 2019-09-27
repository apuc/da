<?php


namespace backend\modules\sima_land\controllers;

use Classes\Wrapper\IUrls;
use Exception;
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

    /**
     * @param int $page
     * @param null $path
     * @param null $level
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionQuery($page = 1 , $path = null , $level = null)
    {
        $this->currentPage = $page;
        $this->level = $level;
        $this->path = $path;

        list($searchModel , $dataProvider) = $this->createData($page ,
            $this->runQuery(IUrls::Category , array(
                'path' => $path ,
                'level' => $level ,
                'page' => $page )));

        return $this->render('index' , [
            'searchModel' => $searchModel ,
            'dataProvider' => $dataProvider
        ]);
    }

}
