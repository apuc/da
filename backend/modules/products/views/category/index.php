<?php

use common\classes\Debug;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\products\models\CategoryProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-product-index">

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

            [
                'attribute' => 'id',
                'label' => 'Название',
                'value' => function($model){
                    return $model->name;
                },
                'filter'    => kartik\select2\Select2::widget([
                    'value' => isset(Yii::$app->request->queryParams['CategoryProductSearch']['id'])? Yii::$app->request->queryParams['CategoryProductSearch']['id']: null,
                    'name' => 'CategoryProductSearch[id]',
                    'data' => \yii\helpers\ArrayHelper::map($allCategories,'id', 'name'),
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            'slug',
            [
                'attribute' => 'parent_id',
                'value' => function($model){
                    if($parent = \common\models\db\CategoryShop::findOne($model->parent_id))
                        return $parent->name;
                },
                'filter'    => kartik\select2\Select2::widget([
                        'value' => isset(Yii::$app->request->queryParams['CategoryProductSearch']['parent_id'])? Yii::$app->request->queryParams['CategoryProductSearch']['parent_id']: null,
                    'name' => 'CategoryProductSearch[parent_id]',
                    'data' => \yii\helpers\ArrayHelper::map($allCategories,'id', 'name'),
                    'options' => ['placeholder' => 'Начните вводить...','class' => 'form-control'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]),
            ],
            'icon',
            //'meta_title',
            //'meta_description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
