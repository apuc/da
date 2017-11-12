<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\currency\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('exchange_rates', 'Currencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!--        --><? //= Html::a('Create Currency', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'num_code',
            'char_code',
            'name:ntext',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    switch ($model->status) {
                        case 0:
                            return 'Скрыта';
                        case 1:
                            return 'Доступна для показа';
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', [
                    0 => 'Скрыта',
                    1 => 'Доступна для показа',
                ], ['class' => 'form-control', 'prompt' => '']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
