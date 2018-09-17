<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \common\models\db\CategoryShop;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\service\models\CategoryShopSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории услуг';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-shop-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
