<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */

$this->title = Yii::t('company', 'Update {modelClass}: ', [
    'modelClass' => 'Company',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('company', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('company', 'Update');
?>
<div class="company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
