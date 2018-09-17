<?php

use common\classes\Debug;
use common\models\db\Currency;
use common\models\db\CurrencyRate;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\currency\models\CurrencyRateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('currency', 'Currency Rates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('currency', 'Create Currency Rate'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'date',
            [
                'attribute' => 'currency_from_id',
                'format' => 'raw',
                'value' => function ($model) {
                    return $model->currencyFrom->name;
                },
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'currency_from_id',
                        'data' => ArrayHelper::map(Currency::find()->all(), 'id', 'name'),
                        'options' => [
                            'placeholder' => Yii::t('currency', 'Select a state ...'),
                            'class' => 'form-control'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])
            ],
            [
                'attribute' => 'currency_to_id',
                'format' => 'text',
                'value' => function ($model) {
                    return $model->currencyTo->name;
                },
                'filter' => Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'currency_to_id',
                        'data' => ArrayHelper::map(Currency::find()->all(), 'id', 'name'),
                        'options' => [
                            'placeholder' => Yii::t('currency', 'Select a state ...'),
                            'class' => 'form-control'
                        ],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])
            ],
            'rate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
