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

class CategoriesController extends Controller
{
    public $count = 1;

    /**
     * Lists all categories models.
     * @return mixed
     * @throws Exception
     */
    public function actionIndex()
    {
        $resultData = Wrapper::objectToArray(Wrapper::runFor(IUrls::Category)
            ->getPage(1)
            ->getItemFromJson());

        $searchModel = [ 'id' => null , 'name' => null ];

        $dataProvider = new ArrayDataProvider([
            'key' => 'id' ,
            'allModels' => $resultData ,
            'sort' => array(
                'attributes' => array_keys($resultData[0])
            ) ,
        ]);

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
            'model' => $this->findCategory($id) ,
        ]);
    }

    private function findCategory($id)
    {
        try {
            return Wrapper::runFor(IUrls::Category)->getById($id)->getItemFromJson();
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}
