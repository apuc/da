<?php

use common\models\db\CategoryPostsConsulting;
use common\models\db\Consulting;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category_posts_consulting\models\CategoryPostsConsultingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t( 'faq', 'Category Posts Consultings' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-posts-consulting-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t( 'faq', 'Create Category Posts Consulting' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

            //'id',
            'title',
//            'parent_id',
            [
                'attribute' => 'parent_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    if(empty($model->parent_id)){
                        return 'Нет';
                    }else{
                    return CategoryPostsConsulting::find()->where( [ 'id' => $model->parent_id ] )->one()->title;
                    }
                }


            ],
            //'slug',
            //'dt_add',
//            [
//                'attribute' => 'dt_add',
//                'format'    => 'text',
//                'value'     => function ( $model ) {
//                    return date( 'Y-m-d H:i', $model->dt_add );
//                }
//            ],
//            [
//                'attribute' => 'dt_update',
//                'format'    => 'text',
//                'value'     => function ( $model ) {
//                    return date( 'Y-m-d H:i', $model->dt_update );
//                }
//            ],
            // 'dt_update',
            // 'icon',
            //'type',
            [
                'attribute' => 'type',
                'format'    => 'text',
                'value'     => function($model){
                    if(empty($model->type)){
                        return 'Нет';
                    }else{
                        return Consulting::find()->where(['slug'=>$model->type])->one()->title;
                    }
                }
            ],
            'sort_order',
            [
                'class' => 'yii\grid\ActionColumn'
            ],
        ],
    ] ); ?>
</div>
