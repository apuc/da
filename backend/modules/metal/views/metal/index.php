<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\metal\models\MetalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('metal', 'Metals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
<!--        --><?//= Html::a('Create Metal', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name',
            'full_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
