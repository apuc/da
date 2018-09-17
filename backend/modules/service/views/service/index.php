<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\service\models\ServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Услуги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'attribute' => 'status',
                //'label' => 'Относится к компании',
                'value'    => function( $model ) {
                    return $model::getTypeLabel( $model->status );
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'status', [
                    '1' => 'Опубликован',
                    '0' => 'На модерации',
                    '3' => 'Удален',
                ], [ 'class' => 'form-control', 'prompt' => '' ] ),
            ],
            //'status',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view}'],
        ],
    ]); ?>
</div>
