<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category_company\models\CategoryCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('company', 'Category Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('company', 'Create Category Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'parent_id',
            'descr:ntext',
            [
                'attribute' => 'dt_add',
                'format' => 'text',
                'value' => function($model){
                    return date('Y-m-d H:i', $model->dt_add);
                }
            ],
            // 'dt_update',
            // 'icon',
            // 'meta_title',
            // 'meta_descr',
            // 'slug',
            // 'lang_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
