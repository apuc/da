<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string $photo
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $descr
 * @property integer $status
 * @property string $slug
 * @property integer $lang_id
 * @property string $meta_title
 * @property string $meta_descr
 * @property integer $views
 * @property integer $user_id
 *
 * @property CategoryCompanyRelations[] $categoryCompanyRelations
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['dt_add', 'dt_update', 'status', 'lang_id', 'views', 'user_id'], 'integer'],
            [['descr'], 'string'],
            [['name', 'address', 'phone', 'email', 'photo', 'slug', 'meta_title', 'meta_descr'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('company', 'ID'),
            'name' => Yii::t('company', 'Name'),
            'address' => Yii::t('company', 'Address'),
            'phone' => Yii::t('company', 'Phone'),
            'email' => Yii::t('company', 'Email'),
            'photo' => Yii::t('company', 'Photo'),
            'dt_add' => Yii::t('company', 'Dt Add'),
            'dt_update' => Yii::t('company', 'Dt Update'),
            'descr' => Yii::t('company', 'Descr'),
            'status' => Yii::t('company', 'Status'),
            'slug' => Yii::t('company', 'Slug'),
            'lang_id' => Yii::t('company', 'Lang ID'),
            'meta_title' => Yii::t('company', 'Meta Title'),
            'meta_descr' => Yii::t('company', 'Meta Descr'),
            'views' => Yii::t('company', 'Views'),
            'user_id' => Yii::t('company', 'User ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryCompanyRelations()
    {
        return $this->hasMany(CategoryCompanyRelations::className(), ['company_id' => 'id']);
    }
}
