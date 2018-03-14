<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tariff".
 *
 * @property integer $id
 * @property string $name
 * @property string $descr
 * @property integer $price
 * @property integer $published
 * @property string $icon
 * @property string $title
 *
 * @property TariffServicesRelations[] $tariffServicesRelations
 */
class Tariff extends \yii\db\ActiveRecord
{

    const ID_BASIC = 1;
    const ID_MEDIUM = 2;
    const ID_MAXIMUM = 3;
    const ID_CUSTOM = 4;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tariff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'price', 'icon', 'title'], 'required'],
            [['descr'], 'string'],
            [['price', 'published'], 'integer'],
            [['name', 'icon', 'title'], 'string', 'max' => 255],
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
            'published' => 'Published',
            'icon' => 'Icon',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTariffServicesRelations()
    {
        return $this->hasMany(TariffServicesRelations::className(), ['tariff_id' => 'id']);
    }
}
