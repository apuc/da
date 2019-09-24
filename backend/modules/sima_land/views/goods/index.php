<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sima_land\models\SearchGoods */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Предыдущая страница' , [ 'index'  ] ,
            [ 'class' => 'btn btn-primary' , 'disabled' => $this->context->isPrev ]) ?>
        <?= Html::a('Следующая страница' , [ 'index' ] ,
            [ 'class' => 'btn btn-primary' , 'disabled' => $this->context->isNext ]) ?>
        <?= Html::a('Перейти на страницу' , [ 'goToPage' ] , [ 'class' => 'btn btn-success' ]) ?>
        <?= Html::a('Кастомный запрос' , [ 'customQuery' ] , [ 'class' => 'btn btn-warning' ]) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
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
