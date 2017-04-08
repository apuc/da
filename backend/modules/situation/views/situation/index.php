<?php

use common\models\db\SituationStatus;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\situation\models\SituationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Блок посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="situation-index">

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
            'report_time',
            'descr:ntext',
            [
                'attribute' => 'situation_status_id',
                'value' => function($model){
                    return SituationStatus::findOne($model->situation_status_id)->name;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
