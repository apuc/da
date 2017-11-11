<?php

use common\models\db\Coin;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\coin\models\CoinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('coin', 'Coins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a('Create Coin', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
//            'coin_id',
//            'url:url',
//            'image_url:url',
            'name',
            // 'symbol',
             'coin_name',
            // 'full_name',
             'algorithm',
             'proof_type',
            // 'fully_premined',
             'total_coin_supply',
            // 'pre_mined_value',
            // 'total_coins_free_float',
            // 'sort_order',
            // 'sponsored',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    switch ($model->status) {
                        case Coin::STATUS_NO_ACTIVE:
                            return 'Скрыта';
                        case Coin::STATUS_ACTIVE:
                            return 'Доступна для показа';
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', [
                    Coin::STATUS_NO_ACTIVE => 'Скрыта',
                    Coin::STATUS_ACTIVE => 'Доступна для показа',
                ], ['class' => 'form-control', 'prompt' => '']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
