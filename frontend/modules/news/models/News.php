<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.09.2016
 * Time: 12:33
 */

namespace frontend\modules\news\models;


use backend\modules\tags\models\TagsRelation;
use common\models\db\NewsComments;
use yii\db\ActiveRecord;

class News extends \common\models\db\News
{
    public $categoryId;

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'common\behaviors\Slug',
                'in_attribute' => 'title',
                'out_attribute' => 'slug',
                'translit' => true
            ],
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update', 'dt_public'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
        ];
    }

    public function getTagss()
    {
        return $this->hasMany(TagsRelation::className(), ['post_id' => 'id']);
    }

    public function getComments()
    {
        return $this->hasMany(NewsComments::className(), ['news_id' => 'id']);
    }



    public function attributeLabels()
    {
        $label = parent::attributeLabels();
        $label['categoryId'] = 'Категория';
        return $label;
    }

    public function rules()
    {
        $rules = parent::rules();
        $rules['categoryId'] = [['categoryId'], 'required'];
        return $rules;
    }
}