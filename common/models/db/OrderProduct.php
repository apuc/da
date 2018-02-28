<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "order_product".
 *
 * @property int $product_id
 * @property int $order_id
 * @property int $count
 * @property string $price
 */
class OrderProduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'order_id'], 'required'],
            [['product_id', 'order_id', 'count'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'order_id' => 'Order ID',
            'count' => 'Count',
            'price' => 'Price',
        ];
    }

    public function createOrder()
    {
        return [
            'product_id' => 'Product ID',
            'order_id' => 'Order ID',
            'count' => 'Count',
            'price' => 'Price',
        ];
    }

    public static function primaryKey()
    {
        return [
            'product_id',
            'order_id',
        ];
    }

}
