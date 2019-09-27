<?php


namespace backend\modules\sima_land\controllers;

use Classes\Wrapper\IUrls;
use Exception;


class MarkdownsController extends DefaultController
{
    /**
     * Renders the index view for the module
     * @param $page
     * @return string
     * @throws Exception
     */
    public function actionIndex($page = 1)
    {
        $this->currentPage = $page;

        list($searchModel , $dataProvider) = $this->createData($page ,
            $this->runQuery(IUrls::Goods , array( 'is_markdown' => 1 )));

        return $this->render('index' , [
            'searchModel' => $searchModel ,
            'dataProvider' => $dataProvider
        ]);
    }
}
