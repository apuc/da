<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\coin\models\CoinSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Coin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'coin_id',
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
            'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
