<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 12:33
 */

namespace backend\modules\company\models;


use Yii;

class CompanyForm extends Company
{
    public $cats;
    public function rules()
    {
        return [
            [['name', 'cats'], 'required'],
            [['dt_add', 'dt_update', 'status', 'lang_id', 'views', 'user_id', 'vip', 'tariff_id', 'dt_end_tariff', 'region_id', 'city_id', 'recommended', 'main', 'verifikation', 'start_page'], 'integer'],
            [['descr', 'payment', 'delivery'], 'string'],
            [
                ['name', 'address', 'email', 'photo', 'slug', 'meta_title', 'meta_descr', 'alt'],
                'string',
                'max' => 255,
            ],
        ];
    }

    public function attributeLabels()
    {
        $attributeLabels = parent::attributeLabels();
        $attributeLabels['cats'] = Yii::t('company', 'Category');
        return $attributeLabels;
    }

}