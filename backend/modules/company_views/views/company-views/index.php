<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\company_views\models\CompanyViewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('company_views', 'Company Views');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-views-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'user_id',
                'value' => 'user.username'
            ],
            [
                'attribute' => 'company_id',
                'value' => 'company.name'
            ],
            'date',
            [
                'attribute' => 'ip_address',
                'value' => function($model){
                    return (long2ip($model->ip_address) . " - ". Yii::$app->ipgeobase->getLocation(long2ip($model->ip_address))['city']);
                },
            ],
            'count',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
