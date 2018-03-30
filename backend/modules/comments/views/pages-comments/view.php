<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\PagesComments */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Pages Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-comments-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('comments', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('comments', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('comments', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pages_id',
            'user_id',
            'content:ntext',
            [
                'attribute' => 'dt_add',
                'format' => 'datetime',
            ],
            'parent_id',
            'moder_checked',
            'published',
            'verified',
        ],
    ]) ?>

</div>
