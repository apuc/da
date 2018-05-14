<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 12:33
 */

namespace backend\modules\company\models;


use common\classes\Debug;
use yii\db\ActiveRecord;
use common\models\db\TariffServicesRelations;
use common\models\db\ServicesCompanyRelations;

class Company extends \common\models\db\Company
{
    const COMPANY_PUBLISHED = 0;
    const COMPANY_NEW = 1;
    const COMPANY_MODERATED = 2;
    const COMPANY_DELETED = 3;

    public static function getStatusName($id){
        switch($id){
            case self::COMPANY_PUBLISHED : return "Опубликована";
            case self::COMPANY_NEW : return "Новая";
            case self::COMPANY_MODERATED : return "На модерации";
            case self::COMPANY_DELETED : return "Удалена";
        }
    }
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'name',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
            'region_id' => [
                'class' => 'common\behaviors\SaveRegionId',
                'in_attribute' => 'city_id',
            ],
        ];
    }

    public function setServiceCompanyRel($services = null )
    {
        if (!$services)
        {
            $services = TariffServicesRelations::find()->where(['tariff_id' => $this->tariff_id])
                ->asArray()
                ->all();
        }

        foreach ($services as $service)
        {
            $serCompRel = New ServicesCompanyRelations();
            $serCompRel->company_id = $this->id;
            $serCompRel->services_id = $service['services_id'];
            $serCompRel->save();
        }
    }

    public function setTariff()
    {
        if(!empty($this->tariff_id))
        {
            $timestamp = strtotime(\Yii::$app->request->post('dt_end_tariff'));
            $this->dt_end_tariff = (!$timestamp ) ? 0 : $timestamp ;
            $this->save();

            if($this->tariff_id == 4)
            {
                $this->setServiceCompanyRel(\Yii::$app->request->post('services'));
            }else  $this->setServiceCompanyRel();
            return true;
        }else return false;

    }
}