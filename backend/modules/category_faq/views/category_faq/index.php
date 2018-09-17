<?php

use common\models\db\CategoryFaq;
use common\models\db\Consulting;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category_faq\models\CategoryFaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t( 'faq', 'Category Faqs' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-faq-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t( 'faq', 'Create Category Faq' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

            //'id',
            'title',
            [
                'attribute' => 'parent_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    if ( $model->parent_id == 0 ) {
                        return 'Нет';
                    }
                    $cat = CategoryFaq::find()->where( [ 'id' => $model->parent_id ] )->one();
                    return isset($cat->title) ? $cat->title : '';
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'parent_id', ArrayHelper::map( CategoryFaq::find()->all(), 'id', 'title' ), [
                    'class'  => 'form-control',
                    'prompt' => ''
                ] )
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
//                'value'     => function($model){
//                    return date('Y-m-d H:i',$model->dt_update);
//                }
//            ],
            //'dt_update',
            // 'icon',
            [
                'attribute' => 'type',
                'format'    => 'text',
                'label'     => Yii::t('faq','type'),
                'value'     => function ( $model ) {
                    if ( $model->type == '' ) {
                        return 'Нет';
                    }
                    $con = Consulting::find()->where( [ 'slug' => $model->type ] )->one();
                    return isset($con->title) ? $con->title : '';
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
            ],
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
