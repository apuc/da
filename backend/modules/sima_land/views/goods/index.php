<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sima_land\models\SearchGoods */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->context->currentPage;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4><?= Html::encode('Страница ' . $this->context->currentPage . ' из ' . $this->context->totalPages); ?></h4>

    <p>
        <?= Html::a('Предыдущая страница' , [ 'index' , 'page' => $this->context->prevPage ],
            [ 'class' => 'btn btn-primary']) ?>
        <?= Html::a('Следующая страница' , [ 'index',  'page' => $this->context->nextPage] ,
            [ 'class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            'category_id',
            'price',
            'price_max',
            'price_per_square_meter',
            'price_per_linear_meter',
            'currency',
            'minimum_order_quantity',
            'in_box',
            'max_qty',
            'min_qty',
            'created_at',
            'updated_at',
            'slug',
            [
                'label' => 'Full Info',
                'format' => 'raw',
                'content' => function ($model) {
                    return Html::a('View', ['view', 'id' =>  $model['id']],
                        ['class' => 'btn btn-info']);
                }
            ],
        ]
    ]); ?>
</div>
