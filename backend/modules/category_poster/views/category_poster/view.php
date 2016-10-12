<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\category_poster\models\CategoryPoster */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('poster', 'Category Posters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-poster-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('poster', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('poster', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('poster', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'parent_id',
            'title',
            'descr:ntext',
            'dt_add',
            'dt_update',
            'icon',
            'meta_title',
            'meta_descr',
            'slug',
            'lang_id',
        ],
    ]) ?>

</div>
