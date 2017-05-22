<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vk\models\VkGroupsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Группы ВК';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-groups-index">

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

            'domain',
            'vk_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
