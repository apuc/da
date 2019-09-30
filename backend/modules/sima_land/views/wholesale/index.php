<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Крупный опт';
$this->params['breadcrumbs'][] = $this->context->currentPage;
?>
<div class="wholesale-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4><?= Html::encode('Страница '
            . $this->context->currentPage . ' из ' . $this->context->totalPages); ?></h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider ,
        //'filterModel' => $searchModel ,
        'columns' => [
            [ 'class' => 'yii\grid\SerialColumn' ] ,
            'id' ,
            'title' ,
            'name' ,
            'description' ,
            'short_description' ,
            'catalog_description' ,
            [
                'attribute' => 'image' ,
                'label' => 'Image' ,
                'value' => 'image' ,
                'format' => [ 'image' ]
            ] ,
            'slug' ,
            'is_disabled' ,
            'type_id'
        ]
    ]); ?>
</div>
