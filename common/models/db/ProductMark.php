<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "product_mark".
 *
 * @property int $id
 * @property int $product_id
 * @property int $mark
 */
class ProductMark extends \yii\db\ActiveRecord
{

    const MARK_HIT = 1;
    const MARK_NEW = 2;
    const MARK_STOCK = 3;
    const MARK_DISCOUNT = 4;
    const MARK_LOWEST_PRICE = 5;

    public static $markText = [
        self::MARK_HIT => 'Хит продаж',
        self::MARK_NEW => 'Новинка',
        self::MARK_STOCK => 'Акция',
        self::MARK_DISCOUNT => 'Скидка',
        self::MARK_LOWEST_PRICE => 'Самая низкая цена',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_mark';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id', 'mark'], 'required'],
            [['product_id', 'mark'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'mark' => 'Mark',
        ];
    }
}
