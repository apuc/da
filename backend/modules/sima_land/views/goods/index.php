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
        <?= Html::a('Предыдущая страница', [''], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Следующая страница', [''], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Перейти на страницу', [''], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Кастомный запрос', [''], ['class' => 'btn btn-warning']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'sid',
            'uid',
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
            'trademark_id',
            'country_id',
            'created_at',
            'updated_at',
            'slug',
            [
                'label' => 'Full Info By id',
                'format' => 'raw',
                'content' => function ($model) {
                    return Html::a('View', ['index', 'id' => 'id'],
                        ['class' => 'btn btn-info']);
                }
            ],
        ]
    ]); ?>
</div>
