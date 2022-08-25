<?php

namespace backend\modules\sima_land\controllers;

use backend\modules\sima_land\models\SearchCategories;
use backend\modules\sima_land\models\SearchGoods;
use Classes\Wrapper\IUrls;
use Classes\Wrapper\Wrapper;
use Exception;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `sima_land` module
 */
class DefaultController extends Controller
{
    public $currentPage;
    public $prevPage;
    public $nextPage;
    public $totalPages;
    public $pageSize;

    public $value;

    function init()
    {
        parent::init();
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @param $page
     * @param $url
     * @return array
     * @throws Exception
     */
    public function preparePage($page, $url)
    {
        $query = Wrapper::runFor($url)
            ->getPage($this->currentPage);

        $resultData = $this->setCounts($page, $query);

        if ($url === IUrls::Category) {
            $searchModel = new SearchCategories();
        } else if ($url === IUrls::Goods) {
            $searchModel = new SearchGoods();
        }

        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => $this->pageSize,
                'totalCount' => $this->totalPages],
            'sort' => [
                'attributes' => array_keys($resultData[0])
            ],
        ]);
        return array($searchModel, $dataProvider);
    }

    /**
     * @param $page
     * @param Wrapper $query
     * @return array
     * @throws Exception
     */
    public function setCounts($page, Wrapper $query)
    {
        $this->checkQuery($query);

        $this->totalPages = $query->getMetaFromJson()->pageCount;
        $this->pageSize = $query->getMetaFromJson()->perPage;

        $resultData = Wrapper::objectToArray($query->getItemFromJson());

        if ($page == 1) {
            $this->prevPage = $this->totalPages;
            $this->nextPage = $this->totalPages != $page ? 2 : 1;
        } else if ($this->currentPage != $this->totalPages) {
            $this->prevPage = $this->currentPage - 1;
            $this->currentPage = $this->currentPage++;
            $this->nextPage = $this->currentPage + 1;
        } else if (($this->currentPage == $this->totalPages)) {
            $this->prevPage = $this->currentPage - 1;
            $this->nextPage = 1;
        }
        return $resultData;
    }

    /**
     * @param Wrapper $query
     * @throws Exception
     */
    public function checkQuery(Wrapper $query)
    {
        $json = json_decode($query->getJson(), true);

        if (isset($json['status'])) {
            $message = $json['code'] . ' ' . $json['status'] . ' ' . $json['message'];
            throw new Exception($message);
        }
    }

    public function findById($id, $url)
    {
        try {
            return Wrapper::runFor($url)->getById($id)->getItemFromJson();
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }

    /**
     * @param $page
     * @param Wrapper $query
     * @return array
     * @throws NotFoundHttpException
     */
    public function createData($page, Wrapper $query)
    {
        $resultData = $this->setPageCounts($page, $query);

        $searchModel = new SearchCategories();

        $dataProvider = new ArrayDataProvider([
            'key' => 'id',
            'allModels' => $resultData,
            'pagination' => [
                'pageSize' => $this->pageSize,
                'totalCount' => $this->totalPages],
            'sort' => [
                'attributes' => array_keys($resultData[0])
            ],
        ]);
        return array($searchModel, $dataProvider);
    }

    /**
     * @param $page
     * @param Wrapper $query
     * @return array
     * @throws NotFoundHttpException
     */
    public function setPageCounts($page, Wrapper $query)
    {
        try {
            $resultData = $this->setCounts($page, $query);
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        if (empty($resultData)) {
            throw new NotFoundHttpException("Not Found!");
        }
        return $resultData;
    }

    /**
     * @param $queryPath
     * @param array $data
     * @return Wrapper
     */
    public function runQuery($queryPath, array $data)
    {
        $query = Wrapper::runFor($queryPath)
            ->query($data);
        return $query;
    }
}
