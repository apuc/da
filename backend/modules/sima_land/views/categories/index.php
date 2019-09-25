<?php

use http\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sima_land\models\SearchCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->context->currentPage;

?>
<div class="categories-index">

    <h1><?= Html::encode($this->title); ?></h1>
    <h4><?= Html::encode('Страница ' . $this->context->currentPage . ' из ' . $this->context->totalPages); ?></h4>

    <p>
        <?= Html::a('Предыдущая страница' , [ 'index' , 'page' => $this->context->prevPage ] ,
            [ 'class' => 'btn btn-primary' ]) ?>
        <?= Html::a('Следующая страница' , [ 'index' , 'page' => $this->context->nextPage ] ,
            [ 'class' => 'btn btn-primary' ]) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider ,
        'filterModel' => $searchModel ,
        'columns' => [
            [ 'class' => 'yii\grid\SerialColumn' ] ,
            'id' ,
            'sid' ,
            'name' ,
            'path' ,
            'level' ,
            'full_slug' ,
            [
                'label' => 'Full Info' ,
                'content' => function ($model) {
                    return Html::a('View' , [ 'view' , 'id' => $model['id'] ] ,
                        [ 'class' => 'btn btn-info' ]);
                }
            ] ,
        ]
    ]); ?>
</div>
