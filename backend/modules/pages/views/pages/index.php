<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\pages\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Страницы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

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

            'title',
            [
                'attribute' => 'slug',
                'format' => 'html',
                'value' => function($model){
                    return '<a href="/page/'.$model->slug.'">Ссылка</a> - http://' . $_SERVER['SERVER_NAME'] . '/page/'.$model->slug;
                }
            ],
            [
                'attribute' => 'dt_add',
                'value' => function ($model) {
                    return date('Y-m-d H:i', $model->dt_add);
                },
            ],
            // 'dt_update',
            // 'status',
            // 'meta_title',
            // 'meta_descr',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
