<?php


namespace backend\modules\category_posts_consulting\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class CategoryPostsConsulting extends \common\models\db\CategoryPostsConsulting
{
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

    public static function get_cat_post_by_type($type) {

        $cat_post = ArrayHelper::map( \common\models\db\CategoryPostsConsulting::find()->where( [ 'type' =>  $type] )->all(), 'id', 'title' );

        return Html::dropDownList( 'cat_id', [ ], $cat_post, [ 'class' => 'form-control', 'prompt' =>'Нет','id'=>'postsconsulting-cat_id'] );
    }
}