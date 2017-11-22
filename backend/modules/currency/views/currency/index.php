<?php

use common\models\db\Currency;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\currency\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('currency', 'Currencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('currency', 'Create Currency'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'code',
            'char_code',
            'nominal',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function ($model) {
                    return ArrayHelper::getValue($model->Statuses, $model->status);
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel->Statuses,
                    ['class' => 'form-control', 'prompt' => '']),
            ],
            [
                'attribute' => 'type',
                'format' => 'text',
                'value' => function ($model) {
                    return ArrayHelper::getValue($model->Types, $model->type);
                },
                'filter' => Html::activeDropDownList($searchModel, 'type', $searchModel->Types,
                    ['class' => 'form-control', 'prompt' => '']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
