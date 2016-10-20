<?php

use common\models\db\CategoryFaq;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category_faq\models\CategoryFaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t( 'faq', 'Category Faqs' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-faq-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t( 'faq', 'Create Category Faq' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

            //'id',
            'title',
            [
                'attribute' => 'parent_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    if($model->parent_id==0) return 'Нет';
                    return CategoryFaq::find()->where( [ 'id' => $model->parent_id ] )->one()->title;
                },
            ],
            //'slug',
            //'dt_add',
//             'dt_update',
            // 'icon',
            // 'type',

            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
