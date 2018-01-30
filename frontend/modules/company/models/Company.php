<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.09.2016
 * Time: 13:03
 */

namespace frontend\modules\company\models;


use backend\modules\tags\models\TagsRelation;
use common\models\db\CategoryCompanyRelations;
use yii\db\ActiveRecord;

class Company extends \common\models\db\Company
{
    public $categ;
    public $parentCateg;

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'name',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
            'region_id' => [
                'class' => 'common\behaviors\SaveRegionId',
                'in_attribute' => 'city_id',
            ],
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getcategory_company_relations()
    {
        return $this->hasMany(CategoryCompanyRelations::className(), ['company_id' => 'id']);
    }

    public function getTagss()
    {
        return $this->hasMany(TagsRelation::className(), ['post_id' => 'id']);
    }

    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        $label['categ'] = 'Категория';
        $label['parentCateg'] = 'Категория';
        return $label;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules['categ'] = [['categ'], 'required'];
        $rules['parentCateg'] = [['parentCateg'], 'required'];
        return $rules;
    }
}