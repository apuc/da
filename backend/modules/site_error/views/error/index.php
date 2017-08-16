<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\site_error\models\SiteErrorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Site Errors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-error-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Site Error', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email',
            'url:url',
            'msg:ntext',
            [
                'attribute' => 'dt_add',
                'value' => function($model)
                {
                    return date('H:i:s d:m:Y', $model->dt_add);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
