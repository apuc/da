<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\Journal */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Журналы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            [
                 'attribute' => 'photo',
                 'format' => 'html',
                 'value' => function($model){
                    return Html::img($model->photo, ['width' => 300]);
                 }
            ],
            'iframe:ntext',
            [
                'attribute' => 'dt_add',
                'value' => function($model){
                    return date('d-m-Y', $model->dt_add);
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model){
                    if($model->status == 0)
                        return 'Не опубликован';
                    else if($model->status == 1)
                        return 'Опубликован';
                }
            ],
        ],
    ]) ?>

</div>
