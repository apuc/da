<?php


namespace backend\modules\category_posts_digest\models;


use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class CategoryPostsDigest extends \common\models\db\CategoryPostsDigest{
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

     //   $cat_post = ArrayHelper::map( \common\models\db\CategoryPostsDigest::find()->where( [ 'type' =>  $type] )->all(), 'id', 'title' );

        return Html::dropDownList(
            'categ',
            null,
            ArrayHelper::map(\common\models\db\CategoryPostsDigest::find()->where(['type'=>$type])->all(),'id','title'),
            [  'class'=>'form-control', 'id'=>'categ', 'multiple'=>'multiple']);
        //return Html::dropDownList( 'cat_id', [ ], $cat_post, [ 'class' => 'form-control', 'prompt' =>'Нет','id'=>'postsdigest-cat_id'] );
    }
}