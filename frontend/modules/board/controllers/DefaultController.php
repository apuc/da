<?php

namespace frontend\modules\board\controllers;

use common\classes\Debug;
use frontend\modules\board\models\AdsModel;
use Yii;
use yii\data\Pagination;
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

        $rez = file_get_contents($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&page=' . Yii::$app->request->get('page', 1));

        $rez = json_decode($rez);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $rez->_meta->totalCount,
            'pageSizeParam' => false,
        ]);
        return $this->render('index',
            [
                'ads' => $rez->ads,
                'pagination' => $pagination,
            ]
        );
    }

    public function actionCategoryAds($slug)
    {
        $cat = file_get_contents($this->siteApi . '/category/get-category-by-slug?cat=' . Yii::$app->request->get('slug'));
        $cat = json_decode($cat);
       // Debug::prn($cat);

        $rez = file_get_contents($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&page=' . Yii::$app->request->get('page', 1) . '&catId='. $cat->id);

        $rez = json_decode($rez);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $rez->_meta->totalCount,
            'pageSizeParam' => false,
        ]);
        return $this->render('index',
            [
                'ads' => $rez->ads,
                'pagination' => $pagination,
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
        $this->layout = 'personal_area';
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
        else{
            $model = new AdsModel();
            return $this->render('add-form-ads', ['model' => $model]);
        }

    }

    public function actionGetChildrenCategory()
    {
        if(!empty(Yii::$app->request->post('catId'))) {
            $catId = Yii::$app->request->post('catId');
            //Debug::prn($catId);
            $cat = file_get_contents($this->siteApi . '/category?parent=' . $catId);

            if($cat != '[]'){
                return $this->renderPartial('children-category/category', ['cat' => json_decode($cat)]);
            }
            else{
                $fields = file_get_contents($this->siteApi . '/category/ads-fields?id=' . $catId);
                if(!empty($fields)){
                    $fields = json_decode($fields);
                    $html = '';
                    foreach ($fields as $item){
                        $html .= $this->renderPartial('children-category/filter_fields', ['adsFields' => $item]);
                    }
                    return $html;
                }

            }
        }
    }

    public function actionShowCityList()
    {
        $city = file_get_contents($this->siteApi . '/city?region=' . Yii::$app->request->post('id'));

        return $this->renderPartial('children-category/city-list', ['city' => json_decode($city)]);
    }

    public function actionSearch()
    {
       // Debug::prn(Yii::$app->request->get());

        $rez = file_get_contents($this->siteApi . '/ads/search?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&' . http_build_query( Yii::$app->request->get() ) . '&page=' . Yii::$app->request->get('page', 1) );

        $rez = json_decode($rez);

        //Debug::prn($rez);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $rez->_meta->totalCount,
            'pageSizeParam' => false,
        ]);
        return $this->render('index',
            [
                'ads' => $rez->ads,
                'pagination' => $pagination,
            ]
        );

    }
}
