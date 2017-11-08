<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\currency\models\Currency */

$this->title = Yii::t('exchange_rates', 'Update Currency: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('exchange_rates', 'Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('exchange_rates', 'Update');
?>
<div class="currency-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
