<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\service\models\CategoryShopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории услуг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-shop-index">

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
            'name',
            'slug',
            'parent_id',
            'icon',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
