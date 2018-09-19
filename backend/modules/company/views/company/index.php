<?php

use common\classes\GeobaseFunction;
use kartik\export\ExportMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use common\classes\Debug;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\company\models\CompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('company', 'Companies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('company', 'Create Company'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'name',
        'email',
        'address',
        [
            'attribute' => 'phone',
            'format' => 'text',
            'value' => function($model){
                $text = '';
                foreach ($model['allPhones'] as $phone){
                    $text .= $phone->phone . '; ';
                }
                return $text;
            },
        ],
    ];

//    echo ExportMenu::widget([
//        'dataProvider' => $dataProvider,
//        'columns' => $gridColumns
//    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            //'name',
            [
                'attribute' => 'name',
                'format'    => 'text',
                'filter'    => \kartik\select2\Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'name',
                        'data' => \yii\helpers\ArrayHelper::map(\common\models\db\Company::find()->all(),'id', 'name'),
                        'options' => ['placeholder' => 'Select a state ...','class' => 'form-control'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])
            ],
            [
                'attribute' => 'region_id',
                'label' => 'Регион',
                'format'    => 'text',
                'value' => function($model)
                {
                    return \common\models\db\GeobaseRegion::find()->where(['id' => $model->region_id])->one()->name;
                },
                'filter'    => \kartik\select2\Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'region_id',
                        'data' => \yii\helpers\ArrayHelper::map(GeobaseFunction::getListRegion(),'id', 'name'),
                        'options' => ['placeholder' => 'Select a state ...','class' => 'form-control'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])
            ],
            'address',
            [
                'attribute' => 'phone',
                'format' => 'text',
                'value' => function($model){
                    $text = '';
                    foreach ($model['allPhones'] as $phone){
                        $text .= $phone->phone . '; ';
                    }
                    return $text;
                },
            ],
            /*'email:email',*/
            [
                'attribute' => 'vip',
                'format' => 'text',
                'value' => function($model){
               // Debug::prn($model);
                    return ($model->vip == 0) ? 'Стандарт' : 'VIP';
                },
                'filter'=> Html::activeDropDownList($searchModel, 'vip', [0=>'Стандарт',1=>'VIP'],['class'=>'form-control','prompt' => '']),
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function($model){
                    switch ($model->status){
                        case 0: return 'Опубликована';
                        case 1: return 'Новая';
                        case 2: return 'На модерации';
                        case 3: return 'Удалена';
                    }
                },
                'filter' => Html::activeDropDownList( $searchModel, 'status', [
                    '0' => 'Опубликована',
                    '1' => 'Новая',
                    '2'=>'На модерации',
                    '3'=>'Удалена',
                ], [ 'class' => 'form-control', 'prompt' => '' ] ),
            ],
            // 'photo',
            // 'dt_add',
            // 'dt_update',
            // 'descr:ntext',
            // 'status',
            // 'slug',
            // 'lang_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
