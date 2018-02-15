<?php

use common\models\db\Company;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t( 'news', 'News' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t( 'news', 'Create News' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

            'id',
            'title',
            [
                'attribute' => 'company_id',
                'label' => 'Относится к компании',
                'value'    => 'company.name',
                'filter'    => \kartik\select2\Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'company_id',
                        'data' => \yii\helpers\ArrayHelper::map(Company::find()->all(),'id', 'name'),
                        'options' => ['placeholder' => 'Select a state ...','class' => 'form-control'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]),
            ],
            /*'content:ntext',*/
//            [
//                'attribute' => 'dt_add',
//                'format' => 'text',
//                'value' => function($model){
//                    return date('Y-m-d H:i', $model->dt_add);
//                }
//            ],
            [
                'attribute' => 'dt_update',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    return date( 'Y-m-d H:i', $model->dt_update );
                },
//                'filter'    => Html::
            ],

            //'dt_add',
            //'dt_update',
            // 'slug',
            // 'tags',
            // 'photo',
            [
                'attribute' => 'status',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    $st = 0;
                    switch ( $model->status ) {
                        case 0:
                            $st = 'Опубликована';
                            break;
                        case 1:
                            $st = 'На модерации';
                            break;
                        case 3:
                            $st = 'Отложена';
                            break;
                    }

                    return $st;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'status', [
                    '0' => 'Опубликована',
                    '1' => 'На модерации',
                    '3'=>'Отложена',
                ], [ 'class' => 'form-control', 'prompt' => '' ] ),
            ],
            [
                'attribute' => 'rss',
                'format' => 'raw',
                'value' => function ( $model) {
                    $html = '';
                    if ($model->rss == 1) {
                        $html = '<span class="sucseesRss"></span>';
                    }else{
                        $html = '<span class="errorRss"></span>';
                    }
                    return $html;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'rss', [
                    '0' => 'Нет',
                    '1' => 'Да',
                ], [ 'class' => 'form-control', 'prompt' => '' ] ),
            ],
            [
                'label' => 'Ссылка',
                'format'    => 'raw',
                'value'     => function ( $model ) {
                    return Html::a('Перейти',
                        Yii::$app->urlManagerFrontend->createUrl(['news/default/view', 'slug'=>$model->slug]),
                        ['target' => '_blank']);
                },
            ],
            // 'lang_id',

            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
