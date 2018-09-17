<?php

use common\models\db\CategoryPostsDigest;
use common\models\db\Consulting;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category_posts_digest\models\CategoryPostsDigestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t( 'faq', 'Category Posts Digests' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-posts-digest-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t( 'faq', 'Create Category Posts Digest' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

            //'id',
            'title',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    if ( $model->parent_id == 0 ) {
                        return 'Нет';
                    }

                    return CategoryPostsDigest::find()->where( [ 'id' => $model->parent_id ] )->one()->title;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'parent_id', ArrayHelper::map( CategoryPostsDigest::find()->all(), 'id', 'title' ), [
                    'class'  => 'form-control',
                    'prompt' => ''
                ] )
            ],
            //'slug',
//            'dt_add',
//            'dt_update',
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
//                'value'     => function($model){
//                    return date('Y-m-d H:i',$model->dt_update);
//                }
//            ],
            // 'icon',
            //'type',
            [
                'attribute' => 'type',
                'format'    => 'text',
                'label'     => Yii::t('faq','type'),
                'value'     => function ( $model ) {
                    if ( $model->type == '' ) {
                        return 'Нет';
                    }

                    return Consulting::find()->where( [ 'slug' => $model->type ] )->one()->title;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'type', ArrayHelper::map( Consulting::find()->all(), 'id', 'title' ), [
                    'class'  => 'form-control',
                    'prompt' => ''
                ] ),
            ],
//            'sort_order',
            [
                'attribute'=>'sort_order',
                'label'=> Yii::t('faq','Sort Order'),
                'value'=>function($model){
                    if(!empty($model->sort_order)){
                        return $model->sort_order;
                    }else{
                        return '';
                    }
                }
            ],
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
