<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property integer $id
 * @property string $name
 * @property string $descr
 * @property integer $price
 * @property string $name_serv
 * @property string $val
 *
 * @property ServicesCompanyRelations[] $servicesCompanyRelations
 * @property TariffServicesRelations[] $tariffServicesRelations
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['descr'], 'string'],
            [['price'], 'integer'],
            [['name', 'name_serv', 'val'], 'string', 'max' => 255],
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
            'descr' => 'Descr',
            'price' => 'Price',
            'name_serv' => 'Name Serv',
            'val' => 'Val',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServicesCompanyRelations()
    {
        return $this->hasMany(ServicesCompanyRelations::className(), ['services_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariffServicesRelations()
    {
        return $this->hasMany(TariffServicesRelations::className(), ['services_id' => 'id']);
    }
}
