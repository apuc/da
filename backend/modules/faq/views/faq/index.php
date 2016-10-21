<?php

use common\models\db\Company;
use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\faq\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t( 'faq', 'Faqs' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t( 'faq', 'Create Faq' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

            //'id',
            'question',
            'answer:ntext',
            // 'dt_add',
            //'dt_update',
            // 'slug',
            // 'views',
            //'user_id',
            [
                'attribute' => 'user_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    if ( $model->user_id == 0 ) {
                        return 'Нет';
                    }

                    return User::find()->where( [ 'id' => $model->user_id ] )->one()->username;
                }
            ],
            // 'type',
            //'company_id',
            [
                'attribute' => 'company_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    if ( $model->company_id == 0 ) {
                        return 'Нет';
                    }

                    return Company::find()->where( [ 'id' => $model->company_id ] )->one()->name;
                }
            ],

            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
