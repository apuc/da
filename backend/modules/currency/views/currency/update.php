<?php

use common\models\db\Currency;
use common\models\db\CurrencyCoin;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model Currency */
/* @var $coin CurrencyCoin */

$this->title = Yii::t('currency', 'Update Currency: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('currency', 'Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('currency', 'Update');
?>
<div class="currency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'coin' => $coin
    ]) ?>

</div>
