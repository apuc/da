<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\company\models\SocCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soc Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soc-company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Soc Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'company_id',
            'link',
            'soc_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
