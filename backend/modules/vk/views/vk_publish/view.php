<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkStream */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vk Streams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-stream-view">

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
            'vk_id',
            'from_id',
            'owner_id',
            'owner_type',
            'dt_add',
            'post_type',
            'text:ntext',
            'from_type',
            'status',
            'comment_status',
            'title',
            'meta_descr'
        ],
    ]) ?>

</div>
