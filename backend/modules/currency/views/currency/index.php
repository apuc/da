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
            [
                'attribute' => 'nominal',
                'contentOptions' => ['style' => 'width:75px;  min-width:75px;'],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($searchModel, $key) {
                    return Html::activeDropDownList($searchModel, 'status', $searchModel->Statuses,
                        [
                            'class' => 'form-control',
                            'id' => "currency-status-$searchModel->id",
                            'onchange' => "
                                $.ajax({
                                  url: \"/secure/currency/currency/change-status\",
                                  type: \"post\",
                                  data: { id: $key, status: $(\"#currency-status-$searchModel->id\").val()},
                                });"
                        ]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel->Statuses,
                    ['class' => 'form-control', 'prompt' => '']),
                'contentOptions' => ['style' => 'width:235px;  min-width:150px;'],
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
