<?php

namespace frontend\modules\board\controllers;

use common\classes\Debug;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `board` module
 */
class DefaultController extends Controller
{
    public $siteApi;

    public function beforeAction($action)
    {
        $this->siteApi = Yii::$app->params['site-api'];
        return parent::beforeAction($action);
    }


    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {

        /*Debug::prn(Yii::$app->request->userIP);
        Debug::prn($_SERVER);*/

        $ads = file_get_contents($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds');
        $cat = file_get_contents($this->siteApi . '/category?parent=0');

        return $this->render('index',
            [
                'ads' => json_decode($ads),
                'category' => json_decode($cat),
            ]
        );
    }

    public function actionView($slug, $id)
    {
        $ads = file_get_contents($this->siteApi . '/ads/' . $id . '?expand=adsImgs,adsFieldsValues');

        return $this->render('view',
            [
                'ads' => json_decode($ads),
            ]
        );
    }

    public function actionCreate()
    {
        if(Yii::$app->request->post()){

            $sURL = $this->siteApi . '/ads/create'; // URL-адрес POST

            unset($_POST['_csrf']);

            $sPD = http_build_query($_POST); // Данные POST
            $aHTTP = [
                'http' => // Обертка, которая будет использоваться
                    [
                        'method'  => 'POST', // Метод запроса
                        // Ниже задаются заголовки запроса
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $sPD,
                    ]
            ];
            $context = stream_context_create($aHTTP);
            $contents = file_get_contents($sURL, false, $context);
            echo $contents;
        }

        return $this->render('add-form-ads');
    }

    public function actionGetChildrenCategory()
    {
        if(!empty(Yii::$app->request->post('catId'))) {
            $cat = file_get_contents($this->siteApi . '/category?parent=' . Yii::$app->request->post('catId'));

            if($cat != '[]'){
                return $this->renderPartial('children-category/category', ['cat' => json_decode($cat)]);
            }
            else{
                Debug::prn($cat);
            }
        }
    }
}
