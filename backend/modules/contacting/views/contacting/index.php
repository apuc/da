<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\contacting\models\ContactingSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('contacting', 'Contactings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('contacting', 'Create Contacting'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user_id',
            'type',
            'content',
            'dt_add',
            // 'dt_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
