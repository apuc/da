<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "metal".
 *
 * @property integer $id
 * @property string $name
 * @property string $full_name
 *
 * @property MetalRates[] $metalRates
 */
class Metal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'metal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 2],
            [['full_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('metal', 'Name'),
            'full_name' => Yii::t('metal', 'Full Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetalRates()
    {
        return $this->hasMany(MetalRates::className(), ['metal_id' => 'id']);
    }
}
