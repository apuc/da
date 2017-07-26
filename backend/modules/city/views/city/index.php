<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\city\models\CitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Города';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить город', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            /*'region_id',*/
            [
                'attribute' => 'region_id',
                'format' => 'text',
                'value' => function ( $model)
                {
                    return \common\classes\GeobaseFunction::getRegionName($model->region_id);
                },

                'filter'    =>
                    \kartik\select2\Select2::widget(
                        [
                            'model' => $searchModel,
                            'attribute' => 'region_id',
                            'data' => \yii\helpers\ArrayHelper::map(\common\models\db\GeobaseRegion::find()->all(), 'id', 'name'),
                            'options' => ['placeholder' => 'Начните вводить'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]
                    ),
            ],
            //'latitude',
            //'longitude',
            [
                'attribute' => 'status',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    $st = '';
                    switch ( $model->status ) {
                        case 1:
                            $st = 'Опубликован';
                            break;
                        case 0:
                            $st = 'Не опубликован';
                            break;

                    }

                    return $st;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'status', [
                    '1' => 'Опубликован',
                    '0' => 'Не опубликован',
                ], [ 'class' => 'form-control', 'prompt' => '' ] ),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
