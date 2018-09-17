<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи Google+';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="google-plus-users-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Обновить информацию', ['/console.php?p=google/get-users-info'], ['class' => 'btn btn-success']) ?>    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            'id',
            'display_name',
            [
                'attribute' => 'image',
                'format' => 'html',
                'value' => function($model){
                    return Html::img($model->image, ['width'=>'50px']);
                }
            ],
            'user_id',
            'url:url',
            [
                'attribute' => 'Parsing',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('Парсить', ['/console.php?p=google/get-user-posts&id='.$model->user_id], ['class' => 'btn btn-success', 'data-id' => $model->user_id]);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
