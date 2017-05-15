<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vk\models\VkAuthorsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Авторы ВК';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-authors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <? /*= Html::a('Create Vk Authors', ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img($model->photo);
                },
            ],
            [
                'attribute' => 'screen_name',
                'format' => 'html',
                'value' => function($model){
                    return Html::a('https://vk.com/' . $model->screen_name,'https://vk.com/' . $model->screen_name);
                }
            ],
            'first_name',
            'last_name',
            [
                'attribute' => 'sex',
                'value' => function ($model) {
                    return $model->sex === 1 ? 'Ж' : 'М';
                },
            ],
            // 'screen_name',
            // 'photo',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
