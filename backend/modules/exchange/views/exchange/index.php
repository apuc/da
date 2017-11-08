<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\exchange\models\ExchangeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('exchange_rates', 'Exchanges');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Create Exchange', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'num_code',
            'char_code',
            'nominal',
            'name:ntext',
             'value',
             'previous',
            [
                'attribute' => 'date',
                'value' => function ($model) {
                    return date('d.m.Y', $model->date);
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
