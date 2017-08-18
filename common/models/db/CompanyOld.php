<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "company_old".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $photo
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $descr
 * @property integer $status
 * @property string $slug
 * @property integer $lang_id
 * @property string $meta_title
 * @property string $meta_descr
 * @property integer $views
 * @property integer $user_id
 * @property integer $vip
 * @property integer $tariff_id
 * @property integer $dt_end_tariff
 * @property integer $region_id
 * @property integer $city_id
 * @property integer $recommended
 * @property integer $main
 */
class CompanyOld extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_old';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'region_id', 'city_id'], 'required'],
            [['dt_add', 'dt_update', 'status', 'lang_id', 'views', 'user_id', 'vip', 'tariff_id', 'dt_end_tariff', 'region_id', 'city_id', 'recommended', 'main'], 'integer'],
            [['descr'], 'string'],
            [['name', 'address', 'phone', 'email', 'photo', 'slug', 'meta_title', 'meta_descr'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'phone' => 'Phone',
            'email' => 'Email',
            'photo' => 'Photo',
            'dt_add' => 'Dt Add',
            'dt_update' => 'Dt Update',
            'descr' => 'Descr',
            'status' => 'Status',
            'slug' => 'Slug',
            'lang_id' => 'Lang ID',
            'meta_title' => 'Meta Title',
            'meta_descr' => 'Meta Descr',
            'views' => 'Views',
            'user_id' => 'User ID',
            'vip' => 'Vip',
            'tariff_id' => 'Tariff ID',
            'dt_end_tariff' => 'Dt End Tariff',
            'region_id' => 'Region ID',
            'city_id' => 'City ID',
            'recommended' => 'Recommended',
            'main' => 'Main',
        ];
    }
}
