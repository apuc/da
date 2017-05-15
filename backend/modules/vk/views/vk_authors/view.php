<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkAuthors */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Vk Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-authors-view">

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
            'first_name',
            'last_name',
            'sex',
            'screen_name',
            'photo',
            'user_id',
        ],
    ]) ?>

</div>
