<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\ServiceReservation */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Бронирование услуг', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-reservation-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'start',
            'end',
            'date',
            [
                'attribute' => 'product.title',
                'label' => 'Услуга'
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Пользователь',
                'value' => function($model){
                    return \common\models\User::findOne($model->user_id)->username;
                }
            ],
        ],
    ]) ?>

</div>
