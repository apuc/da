<?php

use common\models\db\CategoryFaq;
use common\models\db\Company;
use common\models\db\Consulting;
use common\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\faq\models\Faq */

$this->title                   = $model->id;
$this->params['breadcrumbs'][] = [ 'label' => Yii::t( 'faq', 'Faqs' ), 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-view">

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
            'question',
            'answer:ntext',
            'dt_add',
            'dt_update',
            'slug',
            'views',
            //'user_id',
            [
                'attribute' => 'user_id',
                'label'     => 'Пользователь',
                'value'     => User::find()->where( [ 'id' => $model->user_id ] )->one()->username,
            ],
            //'type',
            [
                'attribute' => 'type',
                'label'     => 'Тип',
                'value'     => Consulting::find()->where( [ 'slug' => $model->type ] )->one()->title,
            ],
            //'company_id',
            [
                'attribute' => 'company_id',
                'label'     => 'Организация',
                'value'     => Company::find()->where( [ 'id' => $model->company_id ] )->one()->name,
            ],
            //'cat_id',
            [
                'attribute' => 'cat_id',
                'label'     => 'Категория',
                'value'     => CategoryFaq::find()->where( [ 'id' => $model->cat_id ] )->one()->title
            ]
        ],
    ] ) ?>

</div>
