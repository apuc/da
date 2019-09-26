<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Распродажи';
$this->params['breadcrumbs'][] = $this->context->currentPage;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title . ' (товары со значком −20%) ') ?></h1>
    <h4><?= Html::encode('Страница ' . $this->context->currentPage . ' из ' . $this->context->totalPages); ?></h4>
    <p>
        <?= Html::a('Предыдущая страница' ,
            [ Yii::$app->controller->action->id ,
                'page' => $this->context->prevPage ,
            ] , [ 'class' => 'btn btn-primary btn-sm' ]) ?>
        <?= Html::a('Следующая страница' ,
            [ Yii::$app->controller->action->id ,
                'page' => $this->context->nextPage ,
            ] , [ 'class' => 'btn btn-primary btn-sm' ]) ?>
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
            'image_url' ,
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
