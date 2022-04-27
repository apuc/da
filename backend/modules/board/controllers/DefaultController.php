<?php

namespace backend\modules\board\controllers;

use common\behaviors\AccessSecure;
use common\classes\Debug;
use frontend\modules\board\models\BoardFunction;
use Yii;
use yii\data\Pagination;
use yii\web\Controller;

/**
 * Default controller for the `board` module
 */
class DefaultController extends Controller
{
    public $siteApi;
    public $apiKey;

    function init()
    {
        parent::init();
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessSecure::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        $this->siteApi = Yii::$app->params['site-api'];
        $this->apiKey = Yii::$app->params['api-key'];
        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //Debug::prn($_GET);
        $url = $this->siteApi . '/ads/ads-list-all?limit=20&expand=categoryAds&page=' . Yii::$app->request->get('page', 1) . '&api_key=' . $this->apiKey;
        if (BoardFunction::isDomainAvailible($url)) {
            if (Yii::$app->request->get('status-ads')) {
                $rez = BoardFunction::fileGetContent($this->siteApi . '/ads/ads-list-all?limit=20&expand=categoryAds&page=' . Yii::$app->request->get('page', 1) . '&api_key=' . $this->apiKey . '&status=' . Yii::$app->request->get('status-ads'));
            } else {
                $rez = BoardFunction::fileGetContent($this->siteApi . '/ads/ads-list-all?limit=20&expand=categoryAds&page=' . Yii::$app->request->get('page', 1) . '&api_key=' . $this->apiKey);
            }

            $rez = json_decode($rez);

            if (!isset($rez->_meta->totalCount)) {
                echo $rez;
            } else {
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
        } else {
            return $this->render('error-server');
        }


        //$rez = file_get_contents($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&page=' . Yii::$app->request->get('page',1));


    }

    public function actionView($id)
    {
        $ads = BoardFunction::fileGetContent($this->siteApi . '/ads/' . $id . '?expand=adsImgs,adsFieldsValues' . '&api_key=' . $this->apiKey);

        $ads = json_decode($ads);
        if (!isset($ads->title)) {
            echo $ads;
        } else {
            return $this->render('view',
                [
                    'ads' => $ads,
                ]
            );
        }
    }

    public function actionEditStatus($status, $id)
    {
        BoardFunction::fileGetContent($this->siteApi . '/ads/edit-status?id=' . $id . '&status=' . $status . '&api_key=' . $this->apiKey);
        return $this->redirect(['index']);
    }
}
