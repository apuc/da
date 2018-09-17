<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_company_relations".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property integer $company_id
 *
 * @property Company $company
 * @property CategoryCompany $cat
 */
class CategoryCompanyRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_company_relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'company_id'], 'integer'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryCompany::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(CategoryCompany::className(), ['id' => 'cat_id']);
    }

    public function getcategory_company()
    {
        return $this->hasOne(CategoryCompany::className(), ['id' => 'cat_id']);
    }

    public function getcategory()
    {
        return $this->hasOne(CategoryCompany::className(), ['id' => 'cat_id']);
    }


}
