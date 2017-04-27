<?php

use common\models\db\CategoryFaq;
use common\models\db\Company;
use common\models\db\Consulting;
use common\models\User;
use yii\helpers\ArrayHelper;
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
            // 'question',
            [
                'attribute' => 'question',
                'label'     => Yii::t( 'faq', 'Question' ),
            ],
            // 'answer:ntext',
            // 'dt_add',

            //'dt_update',
            // 'slug',
            // 'views',
            //'user_id',
            [
                'attribute' => 'user_id',
                'format'    => 'text',
                'label'     => Yii::t( 'faq', 'User ID' ),
                'value'     => function ( $model ) {
                    if ( $model->user_id == 0 ) {
                        return 'Нет';
                    }
                    $user = User::find()->where( [ 'id' => $model->user_id ] )->one();
                    return isset($user->username) ? $user->username : '';
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'user_id', ArrayHelper::map( User::find()->all(), 'id', 'username' ), [ 'class'  => 'form-control',
                                                                                                                                               'prompt' => ''
                ] ),
            ],
            // 'type',
            [
                'attribute' => 'type',
                'format'    => 'text',
                'label'     => Yii::t('faq','type'),
                'value'     => function ( $model ) {
                    if ( $model->type == '' ) {
                        return 'Нет';
                    }

                    return Consulting::find()->where( [ 'slug' => $model->type ] )->one()->title;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'type', ArrayHelper::map( Consulting::find()->all(), 'id', 'title' ), [
                    'class'  => 'form-control',
                    'prompt' => ''
                ] ),
            ],
            //'company_id',
            [
                'attribute' => 'company_id',
                'format'    => 'text',
                'label'     => Yii::t( 'faq', 'Company ID' ),
                'value'     => function ( $model ) {
                    if ( $model->company_id == 0 ) {
                        return 'Нет';
                    }

                    return Company::find()->where( [ 'id' => $model->company_id ] )->one()->name;
                }
            ],
            [
                'attribute' => 'cat_id',
                'format'    => 'text',
                'label'     => Yii::t( 'faq', 'Category' ),
                'value'     => function ( $model ) {
                    return CategoryFaq::find()->where( [ 'id' => $model->cat_id ] )->one()->title;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'cat_id', ArrayHelper::map( CategoryFaq::find()->all(), 'id', 'title' ), [ 'class'  => 'form-control',
                                                                                                                                                  'prompt' => ''
                ] ),
            ],
//            [
//                'attribute' => 'dt_add',
//                'format'    => 'text',
//                'value'     => function ( $model ) {
//                    return date( 'Y-m-d H:i', $model->dt_add );
//                }
//            ],
            [
                'attribute' => 'dt_update',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    return date( 'Y-m-d H:i', $model->dt_update );
                }
            ],
//            'sort_order',
            [
                'attribute' => 'sort_order',
                'label'     => Yii::t( 'faq', 'Sort Order' ),
                'value'     => function($model) {
                    if (!empty($model->sort_order)){
                        return $model->sort_order;
                    }else{
                        return '';
                    }
                }
        ],
            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
