<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Подарки';
$this->params['breadcrumbs'][] = $this->context->currentPage;
?>
<div class="gifts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4><?= Html::encode('Страница '
            . $this->context->currentPage . ' из ' . $this->context->totalPages); ?></h4>
    <p>
        <?= Html::a('Первая страница' ,
            [ Yii::$app->controller->action->id ,
                'page' => 1
            ] , [ 'class' => 'btn btn-success btn-sm' ]) ?>
        <?= Html::a('Предыдущая страница' ,
            [ Yii::$app->controller->action->id ,
                'page' => $this->context->prevPage ,
            ] , [ 'class' => 'btn btn-primary btn-sm' ]) ?>
        <?= Html::a('Следующая страница' ,
            [ Yii::$app->controller->action->id ,
                'page' => $this->context->nextPage ,
            ] , [ 'class' => 'btn btn-primary btn-sm' ]) ?>
        <?= Html::a('Последняя страница' , [ Yii::$app->controller->action->id ,
            'page' => $this->context->totalPages
        ] , [ 'class' => 'btn btn-warning btn-sm' ]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider ,
        //'filterModel' => $searchModel ,
        'columns' => [
            [ 'class' => 'yii\grid\SerialColumn' ] ,
            'id' ,
            'name' ,
            'description' ,
            'usage' ,
            'condition' ,
            'started_at' ,
            'expired_at' ,
            'min_sum' ,
            [
                'attribute' => 'image_path' ,
                'label' => 'Image' ,
                'value' => 'image_path' ,
                'format' => [ 'image' ]
            ] ,
            'is_limit_number' ,
            'min_qty' ,
            [
                'label' => 'All Goods' ,
                'content' => function ($model) {
                    return Html::a('Get' , [ 'goods/query' , 'gift_id' => $model['id'] ] ,
                        [ 'class' => 'btn btn-info' ]);
                }
            ] ,
        ]
    ]); ?>
</div>
