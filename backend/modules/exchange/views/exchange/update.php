<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\exchange\models\Exchange */

$this->title = Yii::t('exchange_rates', 'Update Exchange: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('exchange_rates', 'Exchanges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('exchange_rates', 'Update');
?>
<div class="exchange-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
