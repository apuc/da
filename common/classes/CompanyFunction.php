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
}