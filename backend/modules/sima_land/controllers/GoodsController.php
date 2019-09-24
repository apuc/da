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
    public $currentPage;
    public $prevPage;
    public $nextPage;
    public $totalPages;
    public $pageSize;

    /**
     * Lists all goods models.
     * @param int $page
     * @return mixed
     * @throws Exception
     */
    public function actionIndex($page = 1)
    {
        $this->currentPage = $page;

        $query = Wrapper::runFor(IUrls::Goods)
            ->getPage($this->currentPage);

        $this->totalPages = $query->getMetaFromJson()->pageCount;
        $this->pageSize = $query->getMetaFromJson()->perPage;

        $resultData = Wrapper::objectToArray($query->getItemFromJson());

        if ($page == 1) {
            $this->prevPage = 1;
            $this->nextPage = 2;
        } else if ($this->currentPage != $this->totalPages) {
            $this->prevPage = $this->currentPage - 1;
            $this->currentPage = $this->currentPage++;
            $this->nextPage = $this->currentPage + 1;
        }

        $searchModel = [ 'id' => null , 'name' => null ];

        $dataProvider = new ArrayDataProvider([
            'key' => 'id' ,
            'allModels' => $resultData ,
            'pagination' => [ 'pageSize' => $this->pageSize , 'totalCount' => $this->totalPages ] ,
            'sort' => [
                'attributes' => array_keys($resultData[0])
            ] ,
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
