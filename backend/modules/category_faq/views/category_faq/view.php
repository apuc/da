<?php

use common\models\db\CategoryFaq;
use common\models\db\Consulting;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\category_faq\models\CategoryFaq */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = [ 'label' => Yii::t( 'faq', 'Category Faqs' ), 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-faq-view">

    <h1><?= Html::encode( $this->title ) ?></h1>

    <p>
        <?= Html::a( Yii::t( 'faq', 'Update' ), [ 'update', 'id' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>
        <?= Html::a( Yii::t( 'faq', 'Delete' ), [ 'delete', 'id' => $model->id ], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => Yii::t( 'faq', 'Are you sure you want to delete this item?' ),
                'method'  => 'post',
            ],
        ] ) ?>
    </p>

    <?= DetailView::widget( [
        'model'      => $model,
        'attributes' => [
            'id',
            'title',
            //'parent_id',
            [
                'attribute' => 'parent_id',
                'label'=>'Родитель',
                'value'=>  CategoryFaq::find()->where(['id'=>$model->parent_id])->one()->title,
            ],
            'slug',
            'dt_add',
            'dt_update',
            'icon',
            //'type',
            ['attribute'=>'type',
            'label'=>'Тип',
            'value'=> Consulting::find()->where(['slug'=>$model->type ])->one()->title,
            ],
        ],
    ] ) ?>

</div>
