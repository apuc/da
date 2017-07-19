<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 12.07.2017
 * Time: 12:01
 */

namespace common\classes;

use common\models\db\Company;
use common\models\db\CompanyTariffOrder;
use common\models\db\ServicesCompanyRelations;
use yii\helpers\ArrayHelper;

class CompanyFunction
{
    //Получить количество компаний на модерации
    public static function getCompanyCountModer()
    {
        return Company::find()->where(['status' => 1])->count();
    }

    //Получить количество заявок которые еще не одобренны
    public static function getCompanyOrderTarif()
    {
        return CompanyTariffOrder::find()->where(['dt_end_tariff' => 0])->count();
    }


    //Получить массив подключенных услуг компании
    public static function getServiceCompany($id)
    {
        $services = ServicesCompanyRelations::find()
            ->where(['company_id' => $id])
            ->with('services')
            ->all();

        $services = ArrayHelper::getColumn($services, 'services');

        $services = ArrayHelper::map($services, 'name_serv', 'val');

        return $services;
    }
}