<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\tw\models\TwPages */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Twitter страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tw-pages-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Список', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'tw_id',
            'screen_name',
            'icon',
	        ['attribute' => 'status', 'value' => $model->statusText],
        ],
    ]) ?>

</div>
