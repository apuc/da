<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "coin".
 *
 * @property integer $id
 * @property integer $coin_id
 * @property string $url
 * @property string $image_url
 * @property string $name
 * @property string $symbol
 * @property string $coin_name
 * @property string $full_name
 * @property string $algorithm
 * @property string $proof_type
 * @property integer $fully_premined
 * @property string $total_coin_supply
 * @property double $pre_mined_value
 * @property double $total_coins_free_float
 * @property integer $sort_order
 * @property integer $sponsored
 * @property integer $status
 */
class Coin extends \yii\db\ActiveRecord
{

    const STATUS_NO_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coin_id', 'name'], 'required'],
            [['coin_id', 'fully_premined', 'sort_order', 'sponsored', 'status'], 'integer'],
            [['pre_mined_value', 'total_coins_free_float'], 'number'],
            [['url', 'image_url', 'name', 'symbol', 'coin_name', 'full_name', 'algorithm', 'proof_type', 'total_coin_supply',], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coin_id' => Yii::t('coin', 'Coin ID'),
            'url' => Yii::t('coin', 'Url'),
            'image_url' => Yii::t('coin', 'Image Url'),
            'name' => Yii::t('coin', 'Name'),
            'symbol' => Yii::t('coin', 'Symbol'),
            'coin_name' => Yii::t('coin', 'Coin Name'),
            'full_name' => Yii::t('coin', 'Full Name'),
            'algorithm' => Yii::t('coin', 'Algorithm'),
            'proof_type' => Yii::t('coin', 'Proof Type'),
            'fully_premined' => Yii::t('coin', 'Fully Premined'),
            'total_coin_supply' => Yii::t('coin', 'Total Coin Supply'),
            'pre_mined_value' => Yii::t('coin', 'Pre Mined Value'),
            'total_coins_free_float' => Yii::t('coin', 'Total Coins Free Float'),
            'sort_order' => Yii::t('coin', 'Sort Order'),
            'sponsored' => Yii::t('coin', 'Sponsored'),
            'status' => Yii::t('coin', 'Status'),
        ];
    }
}
