<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\instagram\models\InstPhotosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фотографии instagram';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inst-photo-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute' => 'author_img',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img($data->author_img, ['width' => '70px']);
                },
            ],
            'author_name',

            [
                'attribute' => 'photo_url',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::img($data->photo_url, ['width' => '210px']);
                },
            ],
            'caption',
            'slug',
            [

                'format' => 'raw',
                'value' => function($model){

                    if($model->status == 2 || $model->status == 3)
                    {
                        return Html::a('Снять с публикации',"/secure/instagram/photo/unpublish?status=".$model->status."&id=".$model->id, ['class' => 'btn btn-success']);

                    }

                    return Html::a('На публикацию',"/secure/instagram/photo/publish?id=".$model->id, ['class' => 'btn btn-success']);
                }
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
