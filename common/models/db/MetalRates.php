<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "metal_rates".
 *
 * @property integer $id
 * @property integer $metal_id
 * @property string $date
 * @property double $price
 *
 * @property Metal $metal
 */
class MetalRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'metal_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['metal_id'], 'integer'],
            [['date'], 'safe'],
            [['price'], 'number'],
            [['metal_id'], 'exist', 'skipOnError' => true, 'targetClass' => Metal::className(), 'targetAttribute' => ['metal_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'metal_id' => 'Metal ID',
            'date' => Yii::t('metal', 'Date'),
            'price' => Yii::t('metal', 'Price'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetal()
    {
        return $this->hasOne(Metal::className(), ['id' => 'metal_id']);
    }
}
