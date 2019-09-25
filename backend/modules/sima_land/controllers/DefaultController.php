<?php

namespace backend\modules\sima_land\controllers;

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
    public function preparePage($page , $url)
    {
        $query = Wrapper::runFor($url)
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
        return array( $searchModel , $dataProvider );
    }

    public function find($id, $url)
    {
        try {
            return Wrapper::runFor($url)->getById($id)->getItemFromJson();
        } catch (Exception $e) {
            throw new NotFoundHttpException($e->getMessage());
        }
    }
}
