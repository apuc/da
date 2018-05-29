<?php

namespace common\models\db;

use dektrium\user\models\User;
use Yii;

/**
 * This is the model class for table "products_reviews".
 *
 * @property int $id
 * @property int $user_id
 * @property string $content
 * @property int $dt_add
 * @property int $product_id
 * @property int $published
 * @property int $rating
 * @property int $plus
 * @property int $minus
 *
 * @property Products $product
 * @property User $user
 */
class ProductsReviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products_reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'content', 'dt_add', 'product_id', 'rating'], 'required'],
            [['user_id', 'dt_add', 'product_id', 'published', 'rating'], 'integer'],
            [['content'], 'string'],
            [['plus', 'minus'], 'string', 'max' => 512],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::class, 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'content' => 'Content',
            'dt_add' => 'Dt Add',
            'product_id' => 'Product ID',
            'published' => 'Published',
            'rating' => 'Rating',
            'plus' => 'Plus',
            'minus' => 'minus',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
