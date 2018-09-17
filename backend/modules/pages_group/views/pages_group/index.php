<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\pages_group\models\PagesGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-group-index">

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
            'slug',
            [
                'attribute' => 'dt_add',
                'value' => function ($model) {
                    return date('Y-m-d H:i', $model->dt_add);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
