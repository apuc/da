<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\instagram\models\InstPhoto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inst Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inst-photo-view">


    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите удалить это фото?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',

            [
                'format' => 'raw',
                    "attribute"=>"photo_url",
                     "value"=>function($data){
                         return Html::img($data->photo_url);
                     }
            ],
            'author_name',
            [
                'format' => 'raw',
                "attribute"=>"photo_url",
                "value"=>function($data){
                    return Html::img($data->author_img);
                }
            ],
            'pub_date',
            'caption',
            'meta_title',
            'meta_description',
        ],
    ]) ?>

</div>
