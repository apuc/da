<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\Products */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Услуги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-fields-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Опубликовать', ['published', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->hitValue): ?>
            <?= Html::a('Это хит продаж', ['hit', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?php else: ?>
            <?= Html::a('Это не хит продаж', ['hit', 'id' => $model->id], ['class' => 'btn btn-default']) ?>
        <?php endif; ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'price',
            'new_price',
            'description',
            'company.name'
        ],
    ]) ?>

    <ul>
        <?php foreach ($model['productFieldsValues'] as $item): ?>
            <li><strong><?= $item['field']->label?></strong>:<span> <?= $item->value?></span></li>
        <?php endforeach;?>
    </ul>

    <?php foreach ($model['images'] as $item): ?>
        <div class="single-shop__slider-item" style="float: left; display: block;">
            <img src="/<?= $item->img; ?>" alt="<?= $model->title?>" style="width: 150px;margin-right: 10px;"><br>
        </div>
    <?php endforeach; ?>
</div>
