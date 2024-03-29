<?php

use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sima_land\models\SearchCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('sima', 'Category title');
$this->params['breadcrumbs'][] = $this->context->currentPage;

?>
<div class="categories-index">

    <h1><?= Html::encode($this->title); ?></h1>
    <h4><?= Html::encode('Страница ' . $this->context->currentPage . ' из ' . $this->context->totalPages); ?></h4>

    <p>
        <?= Html::a('Первая страница' ,
            [ Yii::$app->controller->action->id ,
                'page' => 1 ,
                empty($this->context->path) ? '' : 'path' => $this->context->path ,
                empty($this->context->level) ? '' : 'level' => $this->context->level
            ] , [ 'class' => 'btn btn-success btn-sm' ]) ?>
        <?= Html::a('Предыдущая страница' ,
            [ Yii::$app->controller->action->id ,
                'page' => $this->context->prevPage ,
                empty($this->context->path) ? '' : 'path' => $this->context->path ,
                empty($this->context->level) ? '' : 'level' => $this->context->level
            ] , [ 'class' => 'btn btn-primary btn-sm' ]) ?>
        <?= Html::a('Следующая страница' ,
            [ Yii::$app->controller->action->id ,
                'page' => $this->context->nextPage ,
                empty($this->context->path) ? '' : 'path' => $this->context->path ,
                empty($this->context->level) ? '' : 'level' => $this->context->level
            ] , [ 'class' => 'btn btn-primary btn-sm' ]) ?>
        <?= Html::a('Последняя страница' , [ Yii::$app->controller->action->id ,
            'page' => $this->context->totalPages ,
            empty($this->context->path) ? '' : 'path' => $this->context->path ,
            empty($this->context->level) ? '' : 'level' => $this->context->level
        ] , [ 'class' => 'btn btn-warning btn-sm' ]) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider ,
        //'filterModel' => $searchModel ,
        'columns' => [
            [ 'class' => 'yii\grid\SerialColumn' ] ,
            'id' ,
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
            [
                'label' => 'All Goods' ,
                'content' => function ($model) {
                    return Html::a('Get' , [ 'goods/query' , 'category_id' => $model['id'] ] ,
                        [ 'class' => 'btn btn-info' ]);
                }
            ] ,
        ]
    ]); ?>
</div>
