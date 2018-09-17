<?php

use common\models\db\CurrencyRate;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model CurrencyRate */

$this->title = Yii::t('currency', 'Update Currency Rate: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('currency', 'Currency Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('currency', 'Update');
?>
<div class="currency-rate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
