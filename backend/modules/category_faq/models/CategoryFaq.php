<?php
/**
 * Created by PhpStorm.
 * User: warya
 * Date: 20.10.2016
 * Time: 14:45
 */

namespace backend\modules\category_faq\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class CategoryFaq extends \common\models\db\CategoryFaq{
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
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
        ];
    }
    public static function get_catfaq_by_type($type) {


        $cat_faq = ArrayHelper::map( CategoryFaq::find()->where( [ 'type' =>  $type] )->all(), 'id', 'title' );

        return Html::dropDownList( 'cat_id', [ ], $cat_faq, [ 'class' => 'form-control', 'prompt' =>'Нет','id'=>'faq-cat_id'] );
    }
}