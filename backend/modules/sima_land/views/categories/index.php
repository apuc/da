<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\sima_land\models\SearchCategories */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->context->currentPage;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title); ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Предыдущая страница' , [ 'index' , 'page' => $this->context->prevPage ],
            [ 'class' => 'btn btn-primary']) ?>
        <?= Html::a('Следующая страница' , [ 'index',  'page' => $this->context->nextPage] ,
            [ 'class' => 'btn btn-primary']) ?>
        <?= Html::a('Перейти на страницу' , [ 'goToPage' ] , [ 'class' => 'btn btn-success' ]) ?>
        <?= Html::a('Кастомный запрос' , [ 'customQuery' ] , [ 'class' => 'btn btn-warning' ]) ?>
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
