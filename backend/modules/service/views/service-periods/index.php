<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\service\models\ServicePeriodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приемы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-periods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать приём', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'product_id',
                'value' => function($model){
                    return $model->product->title;
                }
            ],

            'start',
            'end',
            [
                'attribute' => 'week_days',
                'value' => function($model){
                    $days = json_decode($model->week_days);
                    $result = '';
                    foreach($days as $day)
                        $result .= $day . ', ';
                    return $result;
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
