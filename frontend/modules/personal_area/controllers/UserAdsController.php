<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 01.09.17
 * Time: 14:18
 */

namespace frontend\modules\personal_area\controllers;

use common\classes\Debug;
use frontend\modules\board\models\BoardFunction;
use Yii;
use yii\base\Controller;
use yii\data\Pagination;
use yii\filters\AccessControl;

class UserAdsController extends Controller
{
    public $siteApi;
    public $apiKey;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public $layout = 'personal_area';

    public function beforeAction($action)
    {
        $this->siteApi = Yii::$app->params['site-api'];
        $this->apiKey = Yii::$app->params['api-key'];
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {

        if (!BoardFunction::isDomainAvailible($this->siteApi)){
            return $this->render('error');
        }

        Yii::$app->session->setFlash('warning', 'Данный раздел находится в Бетта тестировании. Спасибо за понимание.');
        $email = \dektrium\user\models\User::find()->where(['id' => Yii::$app->user->id])->one()->email;
        //$email = 12;

        $rez = file_get_contents($this->siteApi . '/ads/index?limit=10&expand=adsImgs,adsFieldsValues,city,region,categoryAds&page=' . Yii::$app->request->get('page', 1) . '&user=' . $email . '&api_key=' . $this->apiKey);

        $rez = json_decode($rez);

        if(!isset($rez->_meta->totalCount)){
            echo $rez;
        }else {
            $pagination = new Pagination([
                'defaultPageSize' => 10,
                'totalCount' => $rez->_meta->totalCount,
                'pageSizeParam' => false,
            ]);

            //Debug::prn($rez->ads);
            return $this->render('index',
                [
                    'ads' => $rez->ads,
                    'pagination' => $pagination,
                ]
            );
        }
    }
}