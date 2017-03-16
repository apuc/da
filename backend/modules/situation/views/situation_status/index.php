<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\situation\models\SituationStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ситуации на блок постах';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="situation-status-index">

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

            /*'id',*/
            'name',
            [
                'attribute' => 'circle',
                'format' => 'html',
                'value' => function($model){
                    return "<div style='background: $model->circle;width: 30px;height: 30px'></div>";
                }
            ],
            [
                'attribute' => 'border',
                'format' => 'html',
                'value' => function($model){
                    return "<div style='background: $model->border;width: 30px;height: 30px'></div>";
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
