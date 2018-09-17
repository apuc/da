<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\tw\models\TwPagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Twitter страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tw-pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            //'tw_id',
            'screen_name',
            [
                'attribute' => 'icon',
                'format' => 'raw',
                'value' => function($model){
                    return Html::img($model->icon);
                },
            ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    return $model->statusText;
                },
            ],
            [
                'label' => 'Информация',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Получить информацию', Url::to(['get-info', 'id' => $model->id]),
                        ['class' => 'btn btn-success']);
                },
            ],
            [
                'label' => 'Парсинг',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Парсить', Url::to(['parse', 'id' => $model->id]),
                        ['class' => 'btn btn-success']);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
