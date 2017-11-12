<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\Coin */

$this->title = Yii::t('coin', 'Update Coin: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('coin', 'Coins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('coin', 'Update');
?>
<div class="coin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
