<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\metal\models\MetalRates */

$this->title = Yii::t('metal', 'Update Metal Rates: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('metal', 'Metal Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('metal', 'Update');
?>
<div class="metal-rates-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
