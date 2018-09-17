<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\geobase_ip\models\GeobaseIpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Geobase Ips';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geobase-ip-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Geobase Ip', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'ip_begin',
            'ip_end',
            'country_code',
            'city_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
