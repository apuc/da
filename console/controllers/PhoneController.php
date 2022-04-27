<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 23.03.2018
 * Time: 10:31
 */

namespace console\controllers;


use common\models\db\Company;
use common\models\db\Phones;
use yii\console\Controller;
use yii\helpers\Console;

class PhoneController extends Controller
{
    function init()
    {
        parent::init();
    }

    public function actionIndex()
    {
        $companies = Company::find()->all();
        foreach ($companies as $company) {

            if ($company->phone != null) {
                $phones = Phones::findOne(['company_id' => $company->id]);
                if (!is_null($phones)) {
                    $phones->phone = $company->phone;
                    $phones->save();
                } else {
                    $arrayPhones = explode(' ', $company->phone);
                    foreach ($arrayPhones as $arrayPhone) {
                        if (!empty($arrayPhone)) {
                            $ph = new Phones();
                            $ph->phone = $arrayPhone;
                            $ph->company_id = $company->id;
                            $ph->save();
                        }
                    }
                }
            }
        }
        $this->stdout("complete \n", Console::FG_GREEN);
    }
}