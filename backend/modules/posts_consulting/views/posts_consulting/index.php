<?php

use common\models\db\CategoryFaq;
use common\models\db\Consulting;
use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\posts_consulting\models\PostsConsultingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t( 'faq', 'Posts Consultings' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-consulting-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t( 'faq', 'Create Posts Consulting' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

//            'id',
            'title',
//            'content:ntext',
//            'dt_add',
            [
                'attribute' => 'dt_add',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    return date( 'Y-m-d H:i', $model->dt_add );
                }
            ],
            [
                'attribute' => 'dt_update',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    return date( 'Y-m-d H:i', $model->dt_update );
                }
            ],
            //'dt_update',
            // 'slug',
            // 'photo',
            //'user_id',
            [
                'attribute' => 'user_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    if ( $model->user_id == 0 ) {
                        return 'Нет';
                    }

                    return User::find()->where( [ 'id' => $model->user_id ] )->one()->username;
                }
            ],
            //'type',
            [
                'attribute' => 'type',
                'format'    => 'text',
                'value'     => function($model){
                    return Consulting::find(['slug'=>$model->type])->one()->title;
                }
            ],
//            'cat_id',
            [
                'attribute' => 'cat_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    return CategoryFaq::find()->where( [ 'id' => $model->cat_id ] )->one()->title;
                }
            ],
            // 'views',

            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
