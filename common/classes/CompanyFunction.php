<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 12.07.2017
 * Time: 12:01
 */

namespace common\classes;

use common\models\db\CategoryCompany;
use common\models\db\Company;
use common\models\db\CompanyTariffOrder;
use common\models\db\ServicesCompanyRelations;
use yii\helpers\ArrayHelper;

class CompanyFunction
{
    //Получить количество компаний на модерации
    public static function getCompanyCountModer()
    {
        return Company::find()->where(['status' => [1,2]])->count();
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


    public static function getCategoryTopMenu($category)
    {
        $rez = [];
        $k = 1;
        foreach ($category as $item){
            if($item['show_menu'] == 1 && $item['parent_id'] == 0){
                $rez[$k] = $item;

                foreach ($category as $value){
                    if($value['parent_id'] == $item['id']){
                        $rez[$k]['childs'][] = $value;
                    }

                }
            }
            $k++;
            if($k == 9) {
                break;
            }
        }

        return $rez;
    }
}