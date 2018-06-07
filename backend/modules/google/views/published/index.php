<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Опубликованные посты Google+';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="google-plus-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить пост', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Google+',
                'format' => 'raw',
                'value' => function ($model) {
                    $user = \common\models\db\GooglePlusUsers::find()->where(['id' => $model->user_id])->one();
                    if ($user) {
                        return Html::a($user->display_name,
                            $model->url,
                            [
                                'target' => '_blank',
                            ]);
                    }

                },
            ],
            [
                'attribute' => 'dt_publish',
                'format' => 'raw',
                'value' => function ($model) {
                    return date('d-m-Y', $model->dt_publish);
                },
            ],
            [
                'attribute' => 'сontent',
                'label' => 'Контент',
                'format' => 'raw',
                'value' => function ($model) {
                    $images = \common\models\db\GooglePlusPhoto::find()
                        ->where(['post_id' => $model->id])->all();
                    $result = $model->title . '<br/>';
                    if($images){
                        foreach($images as $image){
                            $result .= Html::img($image->url, ['width' => 300]);
                        }
                    }
                    return $result;

                },
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->status == 2){
                        return Html::a('Опубликовать', ['#'], ['data-id' => $model->id, 'data-status' => 1, 'class' => 'btn btn-xs btn-success google_stream_edit']);
                    }
                    if($model->status == 1){
                        return Html::a('Снять с публикации', ['#'], ['data-id' => $model->id, 'data-status' => 2, 'class' => 'btn btn-xs btn-success google_stream_edit']);
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
