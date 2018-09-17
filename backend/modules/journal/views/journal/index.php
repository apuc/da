<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\journal\models\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Журналы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать журнал', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($model){
                    return Html::img($model->photo, ['width' => 300]);
                }
            ],
            'iframe:ntext',
            [
                'attribute' => 'dt_add',
                'value' => function($model){
                    return date('d-m-Y', $model->dt_add);
                }
            ],
            [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => function ($model) {
                if($model->status == 0){
                    return Html::a('Опубликовать', ['#'], ['data-id' => $model->id, 'data-status' => 1, 'class' => 'btn btn-xs btn-success journal_edit']);
                }
                if($model->status == 1){
                    return Html::a('Снять с публикации', ['#'], ['data-id' => $model->id, 'data-status' => 0, 'class' => 'btn btn-xs btn-success journal_edit']);
                }
            },
            'filter'    => Html::activeDropDownList( $searchModel, 'status', [
                '1' => 'Опубликованные',
                '0' => 'не опубликованные',
            ], [ 'class' => 'form-control', 'prompt' => '' ] ),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
