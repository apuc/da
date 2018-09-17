<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\poster\models\PosterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('poster', 'Posters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poster-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('poster', 'Create Poster'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            'title',
//            'slug',
//            'dt_add',
//            'dt_update',
            [
                'attribute' => 'dt_update',
                'format' => 'text',
                'value' => function($model){
                    return date('Y-m-d H:i', $model->dt_update);
                }
            ],
//            'dt_event',
            [
                'attribute' => 'dt_event',
                'format' => 'text',
                'value' => function($model){
                    return date('Y-m-d H:i', $model->dt_event);
                }
            ],
            // 'descr:ntext',
            // 'short_descr:ntext',
            // 'price',
            // 'start',
            // 'views',
            [
                'attribute' => 'status',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    $st = 0;
                    switch ( $model->status ) {
                        case 0:
                            $st = 'Опубликована';
                            break;
                        case 1:
                            $st = 'На модерации';
                            break;
                        case 2:
                            $st = 'Удалено пользователем';
                            break;
                    }

                    return $st;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'status', [
                    '0' => 'Опубликована',
                    '1' => 'На модерации',
                    '2' => 'Удалено',
                ], [ 'class' => 'form-control', 'prompt' => '' ] ),
            ],
            // 'meta_title',
            // 'meta_descr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
