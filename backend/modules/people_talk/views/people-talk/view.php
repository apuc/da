<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\people_talk\models\PeopleTalk */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('talk', 'People Talks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="people-talk-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('talk', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('talk', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('talk', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nickname',
            'title',
            'rating',
        ],
    ]) ?>

</div>
