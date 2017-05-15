<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\contacting\models\Contacting */

$this->title = Yii::t('contacting', 'Update {modelClass}: ', [
    'modelClass' => 'Contacting',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacting', 'Contactings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('contacting', 'Update');
?>
<div class="contacting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
