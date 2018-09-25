<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\instagram\models\InstAccountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Аккаунты Instagram';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inst-accounts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить аккаунт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],



            [
                'attribute' => 'profile_img',
                'format' => 'html',
                'value' => function ($data) {


                    return Html::img($data->profile_img, ['width' => '70px']);
                },
            ],
            'username',
            'account_id',
            'iprofile_link:url',
            [
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('Парсить',"account/parse?id=".$model->account_id, ['class' => 'btn btn-success']);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
