<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\tariff\models\TariffSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tariffs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tariff-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tariff', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'descr:ntext',
            'price',
            'published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
