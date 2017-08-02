<?php

use common\models\db\Company;
use common\models\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\company_feedback\models\CompanyFeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return User::findById($model->user_id)->username;
                },
            ],
            [
                'attribute' => 'company_id',
                'value' => function($model){
                    return Company::findById($model->company_id)->name;
                }
            ],
            'feedback:ntext',
            [
                'attribute' => 'dt_add',
                'value' => function ($model) {
                    return date('Y-m-d H:i', $model->dt_add);
                },
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    return ($model->status == 0) ? 'Не опубликован' : 'Опубликован';
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', [0 => 'Не опубликован', 1 => 'Опубликован'], ['class' => 'form-control', 'prompt' => '']),
            ],
            // 'dt_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
