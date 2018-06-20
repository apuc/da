<?php

use common\models\db\CategoryShop;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\CategoryShop */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-shop-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
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
            'name',
            'slug',
            [
                'attribute' => 'parent_id',
                'value' => function($model){
                    $parent = CategoryShop::findOne($model->parent_id);
                    return $parent ? $parent->name : 'Нет';
                }
            ],
            [
                'attribute' => 'icon',
                'format' => 'html',
                'value' => function($model){
                    return '<img src = "' . $model->icon . '" width = "100px">';
                }
            ],
            'meta_title',
            'meta_description',
        ],
    ]) ?>

</div>
