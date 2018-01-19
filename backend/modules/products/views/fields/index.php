<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\products\models\ProductFieldsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Доп поля товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-fields-index">

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

            'id',
            'label',
            'type_id',
            //'template',
            //'name',
            //'interval',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
