<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Распродажи';
$this->params['breadcrumbs'][] = $this->context->currentPage;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4><?= Html::encode('Страница ' . $this->context->currentPage . ' из ' . $this->context->totalPages); ?></h4>
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
            'title' ,
            'start_date' ,
            'expiration_date' ,
            [
                'attribute' => 'image_path' ,
                'label' => 'Image' ,
                'value' => 'image_url' ,
                'format' => [ 'image' ]
            ] ,
            //'image_url' ,
            'slug' ,
            [
                'label' => 'All Goods' ,
                'content' => function ($model) {
                    return Html::a('Get' , [ 'goods/query' , 'offer_id' => $model['id'] ] ,
                        [ 'class' => 'btn btn-info' ]);
                }
            ] ,
        ]
    ]); ?>
</div>
