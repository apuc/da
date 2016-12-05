<?php

use backend\modules\category\models\CategoryNews;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category\models\CategoryNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('category_news', 'Category News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('category_news', 'Create Category News'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'format' => 'text',
                'value' => function($model){
                    return ($model->parent_id == 0)?'Нет': CategoryNews::find()->where(['id'=>$model->parent_id])->one()->title;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'parent_id', ArrayHelper::map(\common\models\db\CategoryNews::find()->all(),'id','title'), [ 'class' => 'form-control', 'prompt' => 'Нет' ] ),
            ],
            //'descr:ntext',
            //'dt_add',
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
            // 'lang_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
