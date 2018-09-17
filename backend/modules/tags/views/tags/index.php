<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\tags\models\SearchTags */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тэги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить тэг', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
