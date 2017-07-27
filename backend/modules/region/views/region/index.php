<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\region\models\RegionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Области';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="region-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить область', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           //'id',
            'name',
            [
                'attribute' => 'status',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    $st = '';
                    switch ( $model->status ) {
                        case 1:
                            $st = 'Опубликована';
                            break;
                        case 0:
                            $st = 'Не опубликована';
                            break;

                    }

                    return $st;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'status', [
                    '1' => 'Опубликована',
                    '0' => 'Не опубликована',
                ], [ 'class' => 'form-control', 'prompt' => '' ] ),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
