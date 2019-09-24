<?php


namespace backend\modules\sima_land\controllers;


use Exception;
use Yii;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;
use yii\web\NotFoundHttpException;

class GoodsController extends Controller
{
    /**
     * Lists all goods models.
     * @return mixed
     * @throws Exception
     */
    public function actionIndex()
    {
        $resultData = Wrapper::objectToArray(Wrapper::runFor(IUrls::Goods)
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
            'title' => "1" ,
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
            'model' => $this->findGoods($id) ,
        ]);
    }

    private function findGoods($id)
    {
        try {
            return Wrapper::runFor(IUrls::Goods)->getById($id)->getItemFromJson();
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}
