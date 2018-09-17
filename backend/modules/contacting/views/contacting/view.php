<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\contacting\models\Contacting */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacting', 'Contactings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacting-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('contacting', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('contacting', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('contacting', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'type',
            'content',
            'answer',
            [
                'attribute' => 'dt_add',
                'format' => 'raw',
                'value' => function ($model) {
                   return date('d-m-Y H:i:s');
                },
            ],
            [
                'attribute' => 'dt_update',
                'format' => 'raw',
                'value' => function ($model) {
                    return date('d-m-Y H:i:s');
                },
            ],
        ],
    ]) ?>

</div>
