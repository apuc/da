<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\coin\models\CoinRatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('coin', 'Coin Rates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coin-rates-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<!--    <p>-->
<!--        --><?//= Html::a('Create Coin Rates', ['create'], ['class' => 'btn btn-success']) ?>
<!--    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'coin_name',
            'date',
            'usd',
            'eur',
             'rub',
            // 'uah',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
