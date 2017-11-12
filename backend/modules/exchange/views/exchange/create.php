<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\exchange\models\Exchange */

$this->title = Yii::t('exchange_rates', 'Create Exchange');
$this->params['breadcrumbs'][] = ['label' => Yii::t('exchange_rates', 'Exchanges'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exchange-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
