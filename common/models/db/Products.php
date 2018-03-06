<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $company_id
 * @property int $category_id
 * @property string $description
 * @property int $price
 * @property int $new_price
 * @property int $status
 * @property string $cover
 * @property int $dt_add
 * @property int $dt_update
 * @property int $user_id
 *
 * @property ProductFieldsValue[] $productFieldsValues
 * @property CategoryShop $category
 * @property Company $company
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'company_id', 'category_id', 'description', 'price'], 'required'],
            [['company_id', 'category_id', 'price', 'new_price', 'status', 'dt_add', 'dt_update', 'user_id'], 'integer'],
            [['description'], 'string'],
            [['title', 'slug', 'cover'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryShop::class, 'targetAttribute' => ['category_id' => 'id']],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::class, 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'company_id' => 'Company ID',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'price' => 'Price',
            'new_price' => 'New Price',
            'status' => 'Status',
            'cover' => 'Cover',
            'dt_add' => 'Dt Add',
            'dt_update' => 'Dt Update',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductFieldsValues()
    {
        return $this->hasMany(ProductFieldsValue::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(CategoryShop::class, ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(ProductsImg::class, ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews()
    {
        return $this->hasMany(ProductsReviews::class, ['product_id' => 'id']);
    }
}
