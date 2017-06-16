<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\company\models\SocCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Социальные сети компаний';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soc-company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить социальную сеть для компании', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'company_id',
            [
                'attribute' =>  'company_id',
                'value'     =>  function($data){
                    return $data->company->name;
                }
            ],
            //'link',
            [
                'attribute'=>'link',
                'value'=>function ($data){
                    return '<a href="'.$data->link.'">'.$data->link.'</a>';
                },
                'format'=>'html'
            ],
            //'soc_type',
            [
                'attribute' =>  'soc_type',
                'value'     =>  function($data){
                    return '<img src="'. $data->socType->icon .'">';
                },
                'format'=>'html'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
