<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\polls\models\PollsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Опросы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polls-index">

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
            'title',
            /*'dt_add',*/
            [
                'attribute' => 'dt_add',
                'format' => 'text',
                'value' => function($model){
                    return date('Y-m-d',$model->dt_add);
                }
            ],
            /*'dt_update',*/
            /*'status',*/

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
