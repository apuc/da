<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 04.07.2017
 * Time: 17:10
 */

namespace backend\modules\company\controllers;


use backend\modules\company\models\OrderTariffSearch;
use common\classes\Debug;
use common\models\db\Company;
use common\models\db\CompanyTariffOrder;
use yii\base\Controller;

class OrderTariffController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new OrderTariffSearch();
        $dataProvider = $searchModel->search();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionToPlugTariff()
    {
        //Debug::prn(\Yii::$app->request->post());
        $request = \Yii::$app->request->post();
        Company::updateAll(
            [
                'tariff_id' => $request['tariffId'],
                'dt_end_tariff' => strtotime($request['timeEnd']),
            ],
            [
                'id' => $request['companyId']
            ]
        );

        CompanyTariffOrder::updateAll(
            [
                'dt_end_tariff' => strtotime($request['timeEnd']),
            ],
            [
                'id' => $request['id']
            ]
        );
    }
}