<?php


namespace backend\modules\sima_land\controllers;

use Classes\Wrapper\IUrls;
use Exception;
use yii\web\NotFoundHttpException;

class GoodsController extends DefaultController
{
    function init()
    {
        parent::init();
    }

    public $category_id;
    public $offer_id;
    public $gift_id;

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
            list($searchModel, $dataProvider) = $this->preparePage($page, IUrls::Goods);
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        return $this->render('view', [
            'model' => $this->findById($id, IUrls::Goods),
        ]);
    }

    public function actionQuery($page = 1, $category_id = null, $offer_id = null, $gift_id = null)
    {
        $this->currentPage = $page;
        $this->category_id = $category_id;
        $this->offer_id = $offer_id;
        $this->gift_id = $gift_id;

        list($searchModel, $dataProvider) = $this->createData($page,
            $this->runQuery(IUrls::Goods, array(
                'category_id' => $category_id,
                'offer_id' => $offer_id,
                'gift_id' => $gift_id,
                'page' => $page)));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
