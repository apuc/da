<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\consulting\models\Consulting */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('consulting', 'Consultings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consulting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('consulting', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('consulting', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('consulting', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'descr:ntext',
            'dt_add',
            'dt_update',
            'slug',
            'icon',
            'views',
            'company_id',
        ],
    ]) ?>

</div>
