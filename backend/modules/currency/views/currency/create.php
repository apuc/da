<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\currency\models\Currency */

$this->title = Yii::t('exchange_rates', 'Create Currency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('exchange_rates', 'Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
