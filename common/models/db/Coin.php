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
 */
class Coin extends \yii\db\ActiveRecord
{
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
            [['coin_id', 'fully_premined', 'sort_order', 'sponsored'], 'integer'],
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
            'coin_id' => 'Coin ID',
            'url' => 'Url',
            'image_url' => 'Image Url',
            'name' => 'Name',
            'symbol' => 'Symbol',
            'coin_name' => 'Coin Name',
            'full_name' => 'Full Name',
            'algorithm' => 'Algorithm',
            'proof_type' => 'Proof Type',
            'fully_premined' => 'Fully Premined',
            'total_coin_supply' => 'Total Coin Supply',
            'pre_mined_value' => 'Pre Mined Value',
            'total_coins_free_float' => 'Total Coins Free Float',
            'sort_order' => 'Sort Order',
            'sponsored' => 'Sponsored',
        ];
    }
}
