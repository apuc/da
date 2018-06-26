<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\tw\models\TwPostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Twitter Посты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tw-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить страницу', ['delete-page', Yii::$app->request->queryParams], ['class' => 'btn btn-danger']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'title',
            //'meta_descr:ntext',
            //'tw_id',
            'content:ntext',
            //'media_url:url',
            'link',
            //'page_id',
            'page_title',
            [
                'attribute' => 'page_icon',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::img($model->page_icon);
                }
            ],
            'dt_add:date',
            //'dt_public',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    return $model->statusText;
                },
                'filter' => Html::dropDownList(
                    'TwPostsSearch[status]',
                    $searchModel->status,
                    $searchModel->statuses,
                    ['class' => 'form-control', 'prompt' => 'Все']
                ),

            ],
            //'slug',
            [
                'label' => 'Действия',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->status === \common\models\db\TwPosts::STATUS_MODERATION
                        ? Html::a('На публикацию', Url::to(['to-public', 'id' => $model->id]), ['class' => 'btn btn-success'])
                        : 'Не доступно';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
