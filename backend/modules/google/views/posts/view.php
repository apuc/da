<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\GooglePlusPosts */
if(isset($model->title))
    $this->title = $model->title;
else
    $this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Google Plus Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="google-plus-posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Назад', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'content',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($model){
                    $result = '';
                    foreach($model->photos as $photo)
                        $result .= Html::img($photo->url) . '<br/>';
                    return $result;
                }
            ],
            'updated',
            'dt_publish',
            'slug',
            'post_id',
            'url:url',
            'user_id',
            [
                'label' => 'Пользователь',
                'value' => function($model){
                    return $model->author->display_name;
                }
            ],
        ],
    ]) ?>

</div>
